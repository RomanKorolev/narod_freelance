<?php

class Projects_model extends CI_Model {

	const ProjectsPerPage = 20;

	public function get_projects($offset = 0){
		$query = $this->db->order_by('id', 'desc')->get('projects', self::ProjectsPerPage, ((int)$offset) * self::ProjectsPerPage);
       	        return $query->result_array();
	}

	public function get_project($id = FALSE){
	        $query = $this->db->get_where('projects', array('id' => $id));
        	$row = $query->row_array();
	        $query = $this->db->get_where('proj_origin', array('id' => $id));
        	$row2 = $query->row_array();
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
	        $this->db->insert('projects_status', $data);
	}
/*
	public function register_user(){
		$this->load->helper('url');

#		$slug = url_title($this->input->post('title'), 'dash', TRUE);

		$data = array(
			'title' => $this->input->post('title'),
			'slug' => $slug,
			'text' => $this->input->post('text')
		);

		return $this->db->insert('users', $data);
	}
*/
}
