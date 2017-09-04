<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Policies_model extends MY_Model {

	public function __construct(){
		parent::__construct();
		$this->abrv = 'policy_';
		$this->from = 'policies';
		$this->id = 'policy_id';
		$this->listSelect = 'policy_id, policy_title, policy_content, policy_show_date, policy_meta_description';
		$this->rowSelect = 'policy_id, policy_title, policy_content, policy_show_date, policy_meta_description';
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
		$this->db->select('policy_file_title, policy_file_name')
				 ->from('policies_file')
				 ->where('policy_file_is_del',0,false)
				 ->where('policy_file_status',1,false)
				 ->order_by('policy_file_created_date', 'asc');

		if( isset($queryData['policy_id']) && $queryData['policy_id'] !=''){
			$queryData['policy_id'] = $this->db->escape($queryData['policy_id']);
			$this->db->where('policy_id', $queryData['policy_id'], FALSE);
		}

		$result = $this->db->get();
		$result = $result->result_array();

		return $result;
	}

}