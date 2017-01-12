<?php

class Projects extends CI_Controller{

        public function __construct(){
                parent::__construct();
                $this->load->model('projects_model');
        }

        public function index($offset = 0){
		session_write_close();

		$offset = (int) $offset;
                $this->load->helper('pager_helper');
		$data = array();
                $data['projects'] = $this->projects_model->get_projects($offset);
	        $data['title'] = 'Все проекты народного фриланса';

                $data['total_projects'] = $this->projects_model->get_total_projects($data);

		#$data['total_pages'] = ceil((1.0 * $projects_count) / self::ProjectsPerPage);
		#$data['projects_count'] = $projects_count;
		
		$data['pager'] = pager("projects", $data['total_pages'], $offset);

	        $this->view_load($data, 'projects/index');
        }

        public function view($id = NULL, $slug = NULL){
		session_write_close();

		$id = (int) $id;
		$data = array();
                $data['project_item'] = $this->projects_model->get_project($id);

	        if (empty($data['project_item'])){
        	        show_404();
	        }
                $this->load->model('tags_model');

	        $data['title'] = $data['project_item']['title'];
		$data['tags'] = $this->tags_model->get_project_tags($id);

	        $this->view_load($data, 'projects/view');
        }
	
	public function create(){
		$this->auth();
		session_write_close();
#		if(!$this->session->loginned){
#			redirect(site_url('login'));
#		}
		$this->load->helper('form');
		$this->load->library('form_validation');

		$data = array();
		$data['title'] = 'Создание нового проекта';

		$this->form_validation->set_rules('title', 'Название проекта', 'required');
		$this->form_validation->set_rules('desc', 'Описание', 'required');

		if ($this->form_validation->run() === FALSE){
		        $this->view_load($data, 'projects/create');
		}else{
			$project = $this->projects_model->new_project();
			$data = array('link' => get_project_url($project['id'], $project['slug']));
		        $data['title'] = "Новый проект успешно создан";
		        $this->view_load($data, 'projects/success');
		}
	}

}
