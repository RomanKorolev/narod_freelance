<?php

class Users_model extends CI_Model {

	public function get_users($login = FALSE){
        	if ($slug === FALSE){
	                $query = $this->db->get('users');
        	        return $query->result_array();
	        }

	        $query = $this->db->get_where('users', array('login' => $login));
        	return $query->row_array();
	}


	public function register_user(){
#		$this->load->helper('url');
#		$slug = url_title($this->input->post('title'), 'dash', TRUE);

		$data = array(
			'login' => $this->input->post('login'),
			'email' => $this->input->post('email'),
			'pass' => $this->input->post('pass')
		);

		return $this->db->insert('users', $data);
	}

}
