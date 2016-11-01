<?php

class Cron_model extends CI_Model {

	public function insert_project($project_item){
		$link = $project_item['link'];
		unset($project_item['link']);
	        $query = $this->db->get_where('proj_origin', array('link' => $link));
		if($query->row_array() !== NULL){
			return;
		}

		echo "INSERT: $link\n";
#		$project_item['slug'] = url_title($project_item['title'], 'dash', TRUE);

		$res = $this->db->insert('projects', $project_item);
		$id = $this->db->insert_id();
		$this->db->insert('proj_origin', array('id' => $id, 'link' => $link));
	}
}
