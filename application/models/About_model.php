<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About_model extends MY_Model {

	public function __construct(){
		parent::__construct();
		$this->abrv = 'about_';
		$this->from = 'about';
		$this->id = 'about_id';
		$this->listSelect = '*';
		$this->rowSelect = '*';
		$this->orderBy = 'created_date';
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
				 ->where($this->abrv.$this->status, 1, false)
				 ->where($this->abrv.$this->is_del,0,false)
				 ->order_by($this->abrv.$this->orderBy, $this->orderType);

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
		$this->db->select('about_file_name')
				 ->from('about_file')
				 ->where('about_file_is_del',0,false)
				 ->order_by('about_file_created_date', 'asc');

		if( isset($queryData['about_id']) && $queryData['about_id'] !=''){
			$queryData['about_id'] = $this->db->escape($queryData['about_id']);
			$this->db->where('about_id', $queryData['about_id'], FALSE);
		}

		$result = $this->db->get();
		$result = $result->result_array();

		return $result;
	}
}