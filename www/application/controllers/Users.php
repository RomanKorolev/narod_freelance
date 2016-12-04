<?php

class Users extends CI_Controller{

        public function __construct(){
                parent::__construct();
                $this->load->model('users_model');
        }

        public function index(){
		session_write_close();
		$data = array();
                $data['users'] = $this->users_model->get_users();
	        $data['title'] = 'Users';

	        $this->view_load($data, 'users/index');
        }

        public function view($login = NULL){
		session_write_close();
		$data = array();
                $data['user_item'] = $this->users_model->get_users($login);

	        if (empty($data['user_item'])){
        	        show_404();
	        }

	        $data['title'] = $data['user_item']['title'];

	        $this->view_load($data, 'users/view');
        }
/*
	public function create(){
		$this->load->helper('form');
		$this->load->library('form_validation');

		$data = array();
		$data['title'] = 'Create a news & item';

		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('text', 'Text', 'required');

		if ($this->form_validation->run() === FALSE){
			$data['form'] = array();
			$data['form']['title'] = $this->input->post('title');
			$data['form']['text'] = $this->input->post('text');
		        $this->view_load($data, 'news/create');
		}else{
			$this->news_model->set_news();
		        $this->view_load($data, 'news/success');
			//$this->load->view('news/success');
		}
	}
*/
}
