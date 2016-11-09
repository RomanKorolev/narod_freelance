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

function H($text){
	return html_escape($text);
}

endif;
