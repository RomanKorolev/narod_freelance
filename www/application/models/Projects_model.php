<?php

class Projects_model extends CI_Model {

        public function __construct(){
                $this->load->database();
        }

	public function get_projects($id = FALSE){
        	if ($id === FALSE){
	                $query = $this->db->get('projects');
        	        return $query->result_array();
	        }

	        $query = $this->db->get_where('projects', array('id' => $login));
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
