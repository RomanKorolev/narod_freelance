<?php

class Projects extends CI_Controller{

        public function __construct(){
                parent::__construct();

                $this->load->model('projects_model');
                $this->load->helper('url_helper');
        }

        public function index(){
		$data = array();
                $data['projects'] = $this->projects_model->get_projects();
	        $data['title'] = 'Projects';

	        $this->view_load($data, 'projects/index');
        }

        public function view($id = NULL, $slug = NULL){
		$data = array();
                $data['project_item'] = $this->projects_model->get_projects($login);

	        if (empty($data['projects_item'])){
        	        show_404();
	        }

	        $data['title'] = $data['project_item']['title'];

	        $this->view_load($data, 'projects/view');
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
