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

		$ip = '';

		foreach(array("REMOTE_ADDR", "HTTP_X_REAL_IP", "HTTP_X_FORWARDED_FOR") as $k){
			if(isset($_SERVER[$k])){
				if(strlen($_SERVER[$k]) > $ip){
					$ip = $_SERVER[$k];
				}
			}
		}

		$data = array(
			'login' => $this->input->post('login'),
			'email' => $this->input->post('email'),
			'pass' => $this->input->post('password'),
			'reg_IP' => $ip

		);

		return $this->db->insert('users', $data);
	}

}
