<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Litigations_model extends MY_Model {

	public function __construct(){
		parent::__construct();
		$this->abrv = 'litigation_';
		$this->from = 'litigations';
		$this->id = 'litigation_id';
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
				 ->where($this->abrv.$this->is_del,0,false)
				 ->where($this->abrv.$this->status,1,false)
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

	public function getNoteList($queryData){
		$this->db->select('litigation_note_title, litigation_note_date, litigation_note_content, litigation_note_hyperlinks')
				 ->from('litigations_note')
				 ->where('litigation_note_is_del',0,false)
				 ->order_by('litigation_note_date', 'ASC');

		if( isset($queryData['litigation_id']) && $queryData['litigation_id'] !=''){
			$queryData['litigation_id'] = $this->db->escape($queryData['litigation_id']);
			$this->db->where('litigation_id', $queryData['litigation_id'], FALSE);
		}

		$result = $this->db->get();
		$result = $result->result_array();

		return $result;
	}

	public function getFileList($queryData){
		$this->db->select('litigation_file_title, litigation_file_name')
				 ->from('litigations_file')
				 ->where('litigation_file_is_del',0,false)
				 ->order_by('litigation_file_created_date', 'asc');

		if( isset($queryData['litigation_id']) && $queryData['litigation_id'] !=''){
			$queryData['litigation_id'] = $this->db->escape($queryData['litigation_id']);
			$this->db->where('litigation_id', $queryData['litigation_id'], FALSE);
		}

		$result = $this->db->get();
		$result = $result->result_array();

		return $result;
	}

}