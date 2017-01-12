<?php

class Logout extends CI_Controller{

        public function index(){
		$data = array();
		$data['title'] = "Выход из аккаунта";
	        $data['nocounters'] = 1;

		if($this->session->loginned){
		        $this->view_load($data, 'logout/index');
		}else{
			$this->view_load($data, 'logout/success');
		}
	}

        public function confirm(){
		$this->load->model('users_model');
		$data = array();
		$data['title'] = "Выход из аккаунта";
	        $data['nocounters'] = 1;

		if($this->session->loginned){
			$this->users_model->logout();
		}
		$this->view_load($data, 'logout/success');
	}

}
