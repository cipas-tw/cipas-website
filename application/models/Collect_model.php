<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Collect_model extends MY_Model {

	public function __construct(){
		parent::__construct();
		$this->abrv = 'collect_plan_';
		$this->from = 'collect';
		$this->id = 'collect_plan_id';
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

	public function getFileList($queryData){
		$this->db->select('collect_plan_file_title, collect_plan_file_name')
				 ->from('collect_file')
				 ->where('collect_plan_file_is_del',0,false)
				 ->where('collect_plan_file_status',1,false)
				 ->order_by('collect_plan_file_created_date', 'asc');

		if( isset($queryData['collect_plan_id']) && $queryData['collect_plan_id'] !=''){
			$queryData['collect_plan_id'] = $this->db->escape($queryData['collect_plan_id']);
			$this->db->where('collect_plan_id', $queryData['collect_plan_id'], FALSE);
		}

		$result = $this->db->get();
		$result = $result->result_array();

		return $result;
	}
}