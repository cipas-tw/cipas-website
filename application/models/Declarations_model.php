<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Declarations_model extends MY_Model {

	public function __construct(){
		parent::__construct();
		$this->abrv = 'declaration_';
		$this->from = 'declarations';
		$this->id = 'declaration_id';
		$this->listSelect = '*';
		$this->rowSelect = '*';
		$this->orderBy = 'show_date';
		$this->orderType = 'DESC';
		$this->is_del = 'is_del';
		$this->status = 'status';
	}

	public function getList($queryData, $limit){
		$this->db->select($this->rowSelect)
				 ->from($this->from)
				 ->where($this->abrv.$this->is_del,0,false)
				 ->where($this->abrv.'show_date <=', date('Y-m-d'))
				 ->where($this->abrv.$this->status,1,false)
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

	public function getData($id){
		$this->db->select($this->rowSelect)
				 ->from($this->from)
				 ->where($this->id, $id)
				 ->where($this->abrv.$this->is_del,0,false);
		$rows = $this->db->get();
		return $rows->row_array();
	}

	public function getExplainList($queryData, $limit){
		$this->db->select('declaration_explain_id, declaration_explain_title, declaration_explain_created_date')
				 ->from('declaration_explain')
				 ->where('declaration_explain_is_del',0,false)
				 ->order_by('declaration_explain_created_date', 'asc');

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

	public function getExplainData($id){
		$this->db->select('declaration_explain_id, declaration_explain_title, declaration_explain_content, declaration_explain_created_date, declaration_explain_edited_date')
				 ->from('declaration_explain')
				 ->where('declaration_explain_id', $id)
				 ->where('declaration_explain_is_del',0,false);
		$rows = $this->db->get();
		return $rows->row_array();
	}

	public function getFileList($queryData){
		$this->db->select('declaration_file_title, declaration_file_name')
				 ->from('declarations_file')
				 ->where('declaration_file_is_del',0,false)
				 ->where('declaration_file_status',1,false)
				 ->order_by('declaration_file_created_date', 'asc');

		if( isset($queryData['declaration_id']) && $queryData['declaration_id'] !=''){
			$queryData['declaration_id'] = $this->db->escape($queryData['declaration_id']);
			$this->db->where('declaration_id', $queryData['declaration_id'], FALSE);
		}

		$result = $this->db->get();
		$result = $result->result_array();

		return $result;
	}
}