<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Interpretations_model extends MY_Model {

	public function __construct(){
		parent::__construct();
		$this->abrv = 'rule_';
		$this->from = 'interpretations';
		$this->id = 'rule_id';
		$this->listSelect = 'rule_id, rule_title, rule_content, rule_show_date, rule_meta_description';
		$this->rowSelect = 'rule_id, rule_title, rule_content, rule_show_date, rule_meta_description';
		$this->orderBy = 'show_date';
		$this->orderType = 'DESC';
		$this->is_del = 'is_del';
		$this->status = 'status';
	}

	public function getList($queryData, $limit){
		$this->db->select($this->listSelect)
				 ->from($this->from)
				 ->where($this->abrv.$this->is_del,0,false)
				 ->where($this->abrv.$this->status,1,false)
				 ->where($this->abrv.'show_date <=', date('Y-m-d'))
				 ->order_by($this->abrv.$this->orderBy, $this->orderType)
				 ->order_by($this->abrv.'created_date', 'DESC');

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

	public function getData($id){
		$this->db->select($this->rowSelect)
				 ->from($this->from)
				 ->where($this->id, $id)
				 ->where($this->abrv.$this->is_del,0,false);
		$rows = $this->db->get();
		return $rows->row_array();
	}

	public function getFileList($queryData){
		$this->db->select('rule_file_title, rule_file_name')
				 ->from('interpretations_file')
				 ->where('rule_file_is_del',0,false)
				 ->where('rule_file_status',1,false)
				 ->order_by('rule_file_created_date', 'asc');

		if( isset($queryData['rule_id']) && $queryData['rule_id'] !=''){
			$queryData['rule_id'] = $this->db->escape($queryData['rule_id']);
			$this->db->where('rule_id', $queryData['rule_id'], FALSE);
		}

		$result = $this->db->get();
		$result = $result->result_array();

		return $result;
	}
}