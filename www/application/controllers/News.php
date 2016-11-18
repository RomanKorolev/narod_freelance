<?php

class News extends CI_Controller{

        public function __construct(){
                parent::__construct();

                $this->load->model('news_model');
        }

        public function index(){
		$data = array();
                $data['news'] = $this->news_model->get_news();
	        $data['title'] = 'News archive';

	        $this->view_load($data, 'news/index');
        }

        public function view($slug = NULL){
		$data = array();
                $data['news_item'] = $this->news_model->get_news($slug);

	        if (empty($data['news_item'])){
        	        show_404();
	        }

	        $data['title'] = $data['news_item']['title'];

	        $this->view_load($data, 'news/view');
        }

#	public 
	protected function create(){
		$this->load->helper('form');
		$this->load->library('form_validation');

		$data = array();
		$data['title'] = 'Create a news item';

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

}
