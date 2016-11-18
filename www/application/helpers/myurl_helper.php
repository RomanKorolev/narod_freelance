<?

if ( !defined('application_helpers_myurl_helper') ):

define('application_helpers_myurl_helper', '1');

function get_project_url($id, $slug){
	return site_url('projects/' . $slug . '_' . $id);
}

function get_projects_page($page){
	return site_url('projects/page-' . $page);
}

function get_tag_url($tag){
	return site_url('tags/' . $tag);
}

function get_refer($local_only = true){
	if(!isset($_SERVER['HTTP_REFERER'])){
		return "";
	}
	$refer = $_SERVER['HTTP_REFERER'];
	if($local_only){
		$url = site_url('');
		if(strpos($refer, $url) === FALSE){
			return "";
		}
	}
	return $refer;
}

function H($text){
	return html_escape($text);
}

endif;
