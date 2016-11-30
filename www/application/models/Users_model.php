<?php

class Users_model extends CI_Model {

	public function get_user($login){
	        $query = $this->db->get_where('users', array('login' => $login));
        	return $query->row_array();
	}

	public function get_users(){
                $query = $this->db->get('users');
       	        return $query->result_array();
	}

	public function register_user(){
#		$this->load->helper('url');#TOTO check and remove help AUTOLOAD
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

	public function user_exist($login){
	        $query = $this->db->get_where('users', array('login' => $login));
       	        return !($query->result_array() === null);
	}

	public function login(){
		$login = $this->input->post('login');
		$pass = $this->input->post('password');
	        $query = $this->db->get_where('users', array('login' => $login));
		$user = $query->row_array();
		if($user == null){
			return false;
		}
		if($user['pass'] != $pass){
			return false;
		}

		$data = array(
			'loginned' => 1,
        		'user_id' => $user['id'],
        		'login'	=> $login,
        		'email'	=> $user['email'],
        		'fname'	=> $user['fname'],
        		'sname'	=> $user['sname'],
			'IP'    => get_ip()
		);
		$this->session->set_userdata($data);
		return true;
	}

}
