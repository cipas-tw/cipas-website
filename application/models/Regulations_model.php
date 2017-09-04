<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Regulations_model extends MY_Model {

	public function __construct(){
		parent::__construct();
		$this->abrv = 'law_';
		$this->from = 'regulations';
		$this->id = 'law_id';
		$this->listSelect = '*';
		$this->rowSelect = '*';
		/*$this->orderBy = 'created_date';
		$this->orderType = 'DESC';*/
		$this->orderBy = 'sort';
		$this->orderType = 'ASC';
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
				 ->where('law_status', 1, false)
				 ->where($this->abrv.$this->is_del,0,false)
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

	// public function getTermsList($id){
	// 	$this->db->select('regulations_chapter.law_chapter_id, regulations_chapter.law_chapter_title, law_terms_content, law_terms_numbering')
	// 			 ->from('regulations_chapter')
	// 			 ->join('regulations_terms', 'regulations_terms.law_chapter_id = regulations_chapter.law_chapter_id')
	// 			 ->where($this->id, $id)
	// 			 ->where('law_terms_is_del',0,false)
	// 			 ->where('law_chapter_is_del',0,false)
	// 			 ->order_by('regulations_chapter.law_chapter_sort', 'asc')
	// 			 ->order_by('law_terms_sort', 'asc');

	// 	$result = $this->db->get();
	// 	$result = $result->result_array();

	// 	return $result;
	// }

	public function getTermsList($id){
		$sql = "SELECT regulations_chapter.law_chapter_id, regulations_chapter.law_chapter_title, law_terms_content, law_terms_numbering
				FROM regulations_chapter
				LEFT JOIN regulations_terms ON regulations_terms.law_chapter_id = regulations_chapter.law_chapter_id
				WHERE law_id = ?
				AND law_chapter_is_del = 0
				AND (law_chapter_is_del = 0 OR law_chapter_is_del is null)
				ORDER BY regulations_chapter.law_chapter_sort ASC , law_terms_sort ASC
		       ";

		$rows = $this->db->query($sql, array($id));	
		return $rows->result_array();
	}

	public function getFileList($queryData){
		$this->db->select('law_file_title, law_file_name')
				 ->from('regulations_file')
				 ->where('law_file_is_del',0,false)
				 ->order_by('law_file_created_date', 'asc');

		if( isset($queryData['law_id']) && $queryData['law_id'] !=''){
			$queryData['law_id'] = $this->db->escape($queryData['law_id']);
			$this->db->where('law_id', $queryData['law_id'], FALSE);
		}

		$result = $this->db->get();
		$result = $result->result_array();

		return $result;
	}
}