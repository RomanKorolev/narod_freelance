<?php

class Tags extends CI_Controller{

        public function __construct(){
                parent::__construct();
                $this->load->model('tags_model');
        }

        public function index(){
		$data = array();
	        $data['title'] = 'Все теги';
		$data['tags'] = $this->tags_model->get_tags();
                $this->view_load($data, 'tags/index');
	}

        public function view($tag){
		$data = array();
	        $data['title'] = 'Все проекты с тегом "' . $tag . '"';
		$data['tags_item'] = $this->tags_model->get_tag($tag);

	        if (empty($data['tags_item'])){
        	        show_404();
	        }
		$data['projects'] = array();
		$data['pager'] = '';
                $this->view_load($data, 'projects/index');
	}

}
