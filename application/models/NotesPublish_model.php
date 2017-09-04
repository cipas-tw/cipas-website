<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NotesPublish_model extends MY_Model {

	public function __construct(){
		parent::__construct();
		$this->abrv = 'notes_publish_';
		$this->from = 'notes_publish';
		$this->id = 'notes_publish_id';
		$this->listSelect = $this->from.'.*';
		$this->rowSelect = $this->from.'.*';
		$this->orderBy = 'created_date';
		$this->orderType = 'DESC';
		$this->is_del = 'is_del';
		$this->status = 'status';
	}

	public function getData($id){
		$this->db->select($this->listSelect)
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
				 ->order_by($this->abrv.$this->orderBy, $this->orderType);

		if( isset($queryData['keyword']) && $queryData['keyword'] !=''){
			$queryData['keyword'] = '%'.$queryData['keyword'].'%';
			$queryData['keyword'] = $this->db->escape(htmlspecialchars($queryData['keyword'], ENT_QUOTES));
			$this->db->where('(`'.$this->abrv.'title` LIKE '. $queryData['keyword'].' or `'.$this->abrv.'content` LIKE '. $queryData['keyword'].')', NULL, FALSE);
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
		$this->db->select('notes_publish_file_title, notes_publish_file_name')
				 ->from('notes_publish_file')
				 ->where('notes_publish_file_is_del',0,false)
				 ->order_by('notes_publish_file_created_date', 'asc');

		if( isset($queryData['notes_publish_id']) && $queryData['notes_publish_id'] !=''){
			$queryData['notes_publish_id'] = $this->db->escape($queryData['notes_publish_id']);
			$this->db->where('notes_publish_id', $queryData['notes_publish_id'], FALSE);
		}

		$result = $this->db->get();
		$result = $result->result_array();

		return $result;
	}
}