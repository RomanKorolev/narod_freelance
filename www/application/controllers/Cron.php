<?php

class Cron extends CI_Controller{

        public function __construct(){
                parent::__construct();
                $this->load->model('cron_model');
        }

        public function index(){
		$this->load->library('curl');
		$this->load->library('translit');

		$this->translit = new Translit();


		$this->curl = new Curl();
		$options = array(
#			CURLOPT_HEADER => 1,		#return headers
			CURLOPT_NOBODY => 0,		#disable (don't return) body 
#			CURLOPT_POST => 1,		#USE POST method 
#			CURLOPT_POSTFIELDS => array(),	#post data
			CURLOPT_RETURNTRANSFER => 1,	#return response
			CURLOPT_SSL_VERIFYPEER => 0,	#DON'T verify ssl sertificat
			CURLOPT_USERAGENT => 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; YPC 3.0.1; .NET CLR 1.1.4322; .NET CLR 2.0.50727)',
			CURLOPT_TIMEOUT => 30,
#			CURLOPT_FAILONERROR => 0,	#if HTTP status > 300 => ERROR
#			CURLOPT_FOLLOWLOCATION => 0,	#autoredirect
#			CURLOPT_MUTE=>0,		#?
#			CURLOPT_SSLVERSION=>1,		#SSL version to use
			CURLOPT_NOPROGRESS => 0,
			CURLOPT_VERBOSE => 1,
			CURLOPT_SSL_VERIFYHOST => 0,#для виртуальных/локальных хостов типа localhost т.е. тех, которых нет в DNS БД
		);
		$this->curl->opt($options);

		$project = array(
			'title' => 'title test',
			'desc' => 'desc test',
			'link' => 'http://test.ru/'
		);
		$this->_load_rss('https://www.fl.ru/rss/all.xml', '_parser_fl_ru');
		$this->_load_rss('https://freelance.ru/rss/projects.xml', '_parser_freelance_ru');
		$this->_load_rss('http://freelansim.ru/rss/tasks');
        }

	protected function _load_rss($url, $callback = NULL){
		$c = &$this->curl;
		try{
			echo "GET: $url\n";
			$res = $c->exec($url);
			$x = simplexml_load_string($res);
			if($x){
				$ch = &$x->channel;
				foreach($ch->item as $ii){
					$new = array();
					$i = & $ii;
					$new['title'] = trim("" . $i->title);
					$new['link'] = "" . $i->link;
					$new['desc'] = "" . $i->description;
					$new['ts'] = strtotime("" . $i->pubDate);
					if($callback){
#						call_user_func(array($this, $callback), $new, $i);
						$this->$callback($new, $i);
					}
					$new['slug'] = preg_replace('#[^A-Za-z\d]+#', '-', $this->translit->to_lat($new['title'], 'utf-8'));
			                $this->cron_model->insert_project($new);
				}
				$ch = NULL;
			}
			$x = NULL;
		}catch(Exception $ex){
			echo $ex;
		}
	}

	protected function _parser_fl_ru(&$project, &$item){
#<category><![CDATA[Программирование / Веб-программирование]]></category>
		if(preg_match('#Бюджет:\s*(\d+)\s*руб#', $project['desc'], $m)){
			$project['budget'] = $m[1];
		}
	}

	protected function _parser_freelance_ru(&$project, &$item){
		if(preg_match('#Бюджет:\s*(\d+)\s*руб#', "" . $project['desc'], $m)){
			$project['budget'] = $m[1];
		}
	}

}
