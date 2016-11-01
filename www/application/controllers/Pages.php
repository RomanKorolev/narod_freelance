<?php

//Loads static pages located in application/views/pages
class Pages extends CI_Controller {

        public function view($page = 'home'){
	        if ( ! file_exists(APPPATH.'views/pages/'.$page.'.php')){
                	// Whoops, we don't have a page for that!
        	        show_404();
	        }

        	$data['title'] = ucfirst($page); // Capitalize the first letter

	        $this->view_load($data, 'pages/'.$page);
        }
}

