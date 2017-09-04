<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hearings_model extends MY_Model {

	public function __construct(){
		parent::__construct();
		$this->abrv = 'hearing_';
		$this->from = 'hearings';
		$this->id = 'hearing_id';
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
		$this->db->select('hearing_note_title, hearing_note_date, hearing_note_content, hearing_note_hyperlinks')
				 ->from('hearings_note')
				 ->where('hearing_note_is_del',0,false)
				 ->order_by('hearing_note_date', 'ASC');

		if( isset($queryData['hearing_id']) && $queryData['hearing_id'] !=''){
			$queryData['hearing_id'] = $this->db->escape($queryData['hearing_id']);
			$this->db->where('hearing_id', $queryData['hearing_id'], FALSE);
		}

		$result = $this->db->get();
		$result = $result->result_array();

		return $result;
	}

}