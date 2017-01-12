<?php

class Projects_model extends CI_Model {

	const ProjectsPerPage = 20;

	public function get_projects($offset = 0){
		$query = $this->db->order_by('id', 'desc')->get('projects', self::ProjectsPerPage, ((int)$offset) * self::ProjectsPerPage);
       	        return $query->result_array();
	}

	public function get_project($id){
		$id = (int) $id;
	        $query = $this->db->get_where('projects', array('id' => $id));
		if(!$query) return null;
        	$row = $query->row_array();
		if(!$row) return null;
	        $query = $this->db->get_where('proj_origin', array('id' => $id));
		if(!$query) return null;
        	$row2 = $query->row_array();
		if(!$row2) return null;
		$row['link'] = $row2['link'];
		return $row;
	}

	public function get_total_projects(&$data){
	        $query = $this->db->query('select count(id) as `cnt` from projects');
		$row = $query->row_array();
		$projects_count = $row['cnt'];
		$data['total_pages'] = ceil((1.0 * $projects_count) / self::ProjectsPerPage);
		$data['projects_count'] = $projects_count;
		return $row['cnt'];
	}

	public function project_status(&$data){
	        $query = $this->db->get_where('projects_status', array('project_id' => $data['project_id']));
		if($row = $query->row_array()){
		        $this->db->update('projects_status', $data, array('project_id' => $data['project_id']));
		}else{
		        $this->db->insert('projects_status', $data);
		}
	}

	public function last_project_id(){
		$query = $this->db->select_max('id', 'MAX')->get('projects');
		if($row = $query->row_array()){
			return $row['MAX'];
		}
		return 0;
	}

	public function new_project(){
		$this->load->library('translit');
		$this->translit = new Translit("utf-8");
		$data = array(
			'user_id' => $this->session->user_id,
			'title' => $this->input->post('title'),
			'budget' => $this->input->post('budget'),
			'desc' => $this->input->post('desc'),
			'slug' => preg_replace('#[^A-Za-z\d]+#', '-', $this->translit->to_lat( $this->input->post('title') )),
			'ts' => time()
		);
	        $this->db->insert('projects', $data);
		$id = $this->db->insert_id();
		return $this->get_project($id);
	}

}
