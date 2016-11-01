<?php

class Projects_model extends CI_Model {

	public function get_projects($id = FALSE){
#var_dump($id);
        	if ($id === FALSE){
	                $query = $this->db->get('projects');
        	        return $query->result_array();
	        }

	        $query = $this->db->get_where('projects', array('id' => $id));
#var_dump($query);
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
