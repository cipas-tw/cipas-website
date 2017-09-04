<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stories_model extends MY_Model {

	public function __construct(){
		parent::__construct();
		$this->abrv = 'history_story_';
		$this->from = 'stories';
		$this->id = 'history_story_id';
		$this->listSelect = '*';
		$this->rowSelect = '*';
		$this->orderBy = 'show_date';
		$this->orderType = 'DESC';
		$this->is_del = 'is_del';
		$this->status = 'status';
	}

	public function getData($id){
		$this->db->select($this->rowSelect)
				 ->from($this->from)
				 ->where($this->id, $id)
				 ->where($this->abrv.$this->is_del,0,false);
		$rows = $this->db->get();
		return $rows->row_array();
	}

	public function getList($queryData, $limit){
		$this->db->select($this->listSelect)
				 ->from($this->from)
				 ->where($this->abrv.$this->is_del,0,false)
				 ->where($this->abrv.$this->status,1,false)
				 ->where($this->abrv.'show_date <=', date('Y-m-d'))
				 ->order_by($this->abrv.$this->orderBy, $this->orderType)
				 ->order_by($this->abrv.'created_date', 'DESC');

		if( isset($queryData['keyword']) && $queryData['keyword'] !=''){
			$queryData['keyword'] = '%'.$queryData['keyword'].'%';
			$queryData['keyword'] = $this->db->escape(htmlspecialchars($queryData['keyword'], ENT_QUOTES));
			$this->db->where('(`'.$this->abrv.'title` LIKE '. $queryData['keyword'].' or `'.$this->abrv.'content` LIKE '. $queryData['keyword'].')', NULL, FALSE);
		}

		if( isset($queryData['startDate']) && $queryData['startDate'] !=''){
			$queryData['startDate'] = $this->db->escape($queryData['startDate']);
			$this->db->where('history_story_created_date >=', $queryData['startDate'], FALSE);
		}

		if( isset($queryData['endDate']) && $queryData['endDate'] !=''){
			$queryData['endDate'] = $this->db->escape($queryData['endDate']);
			$this->db->where('history_story_created_date <=', $queryData['endDate'], FALSE);
		}

		if( $limit ){
			if( $limit[0] != 0 ){
				$this->db->limit($limit[0], $limit[1]);
			}
			$result = $this->db->get();
			$result = $result->result_array();
		}else{
			$result = $this->db->count_all_results();
		}

		return $result;
	}

	public function getFileList($queryData){
		$this->db->select('history_story_file_title, history_story_file_name')
				 ->from('stories_file')
				 ->where('history_story_file_is_del',0,false)
				 ->where('history_story_file_status',1,false)
				 ->order_by('history_story_file_created_date', 'asc');

		if( isset($queryData['history_story_id']) && $queryData['history_story_id'] !=''){
			$queryData['history_story_id'] = $this->db->escape($queryData['history_story_id']);
			$this->db->where('history_story_id', $queryData['history_story_id'], FALSE);
		}

		$result = $this->db->get();
		$result = $result->result_array();

		return $result;
	}
}