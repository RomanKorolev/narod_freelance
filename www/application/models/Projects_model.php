<?php

class Projects_model extends CI_Model {

	const ProjectsPerPage = 20;

	public function get_projects($offset = 0){
		$query = $this->db->order_by('id', 'desc')->get('projects', self::ProjectsPerPage, ((int)$offset) * self::ProjectsPerPage);
       	        return $query->result_array();
	}

	public function get_project($id = FALSE){
	        $query = $this->db->get_where('projects', array('id' => $id));
        	return $query->row_array();
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
