<?php

class Tags_model extends CI_Model {

	public function get_tag($tag){
	        $query = $this->db->get_where('tags', array('tag' => $tag));
		return $query->row_array();
	}

	public function get_tags(){
	        $query = $this->db->get('tags');
       	        return $query->result_array();
	}

	public function get_project_tags($project_id){
		$project_id = (int) $project_id;
		$query = $this->db->query("select * from tags as a where a.id in (select tag_id from project_tags where project_id=$project_id)");
		return $query->result_array();
	}

}
