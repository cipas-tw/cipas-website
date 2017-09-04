<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Journals_model extends MY_Model {

	public function __construct(){
		parent::__construct();
		$this->abrv = 'journal_';
		$this->from = 'journals';
		$this->id = 'journal_id';
		$this->listSelect = '*';
		$this->rowSelect = '*';
		$this->orderBy = 'show_date';
		$this->orderType = 'DESC';
		$this->is_del = 'is_del';
		$this->status = 'status';
	}

	public function getData($id){
		$this->db->select($this->rowSelect.', journal_type_name')
				 ->from($this->from)
				 ->join('journals_type', 'journals_type.journal_type_id = journals.journal_type_id')
				 ->where($this->id, $id)
				 ->where($this->abrv.$this->is_del,0,false);
		$rows = $this->db->get();
		return $rows->row_array();
	}

	public function getList($queryData, $limit){
		$this->db->select($this->listSelect.', journal_type_name')
				 ->from($this->from)
				 ->join('journals_type', 'journals_type.journal_type_id = journals.journal_type_id')
				 ->where($this->abrv.$this->is_del,0,false)
				 ->where($this->abrv.$this->status,1,false)
				 ->where($this->abrv.'show_date <=', date('Y-m-d'))
				 ->order_by($this->abrv.$this->orderBy, $this->orderType);

		if( isset($queryData['keyword']) && $queryData['keyword'] !=''){
			$queryData['keyword'] = '%'.$queryData['keyword'].'%';
			$queryData['keyword'] = $this->db->escape(htmlspecialchars($queryData['keyword'], ENT_QUOTES));
			$this->db->where('(`'.$this->abrv.'title` LIKE '. $queryData['keyword'].' or `'.$this->abrv.'content` LIKE '. $queryData['keyword'].')', NULL, FALSE);
		}

		if( isset($queryData['journalType']) && $queryData['journalType'] !=''){
			$queryData['journalType'] = $this->db->escape($queryData['journalType']);
			$this->db->where($this->from.'.journal_type_id', $queryData['journalType'], FALSE);
		}

		if( isset($queryData['startDate']) && $queryData['startDate'] !=''){
			$queryData['startDate'] = $this->db->escape($queryData['startDate']);
			$this->db->where('journal_created_date >=', $queryData['startDate'], FALSE);
		}

		if( isset($queryData['endDate']) && $queryData['endDate'] !=''){
			$queryData['endDate'] = $this->db->escape($queryData['endDate']);
			$this->db->where('journal_created_date <=', $queryData['endDate'], FALSE);
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
		$this->db->select('journal_file_title, journal_file_name')
				 ->from('journals_file')
				 ->where('journal_file_is_del',0,false)
				 ->order_by('journal_file_created_date', 'asc');

		if( isset($queryData['journal_id']) && $queryData['journal_id'] !=''){
			$queryData['journal_id'] = $this->db->escape($queryData['journal_id']);
			$this->db->where('journal_id', $queryData['journal_id'], FALSE);
		}

		$result = $this->db->get();
		$result = $result->result_array();

		return $result;
	}
	
	public function getJournalTypeList(){
		$this->db->from('journals_type')
				 ->where('journal_type_is_del',0,false)
				 ->order_by('journal_type_created_date', 'asc');

		$result = $this->db->get();
		$result = $result->result_array();

		return $result;
	}
}