<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recoveries_model extends MY_Model {

	public function __construct(){
		parent::__construct();
		$this->abrv = 'repo_';
		$this->from = 'recoveries';
		$this->id = 'repo_id';
		$this->listSelect = 'repo_id, repo_title, repo_content, repo_show_date, repo_meta_description';
		$this->rowSelect = 'repo_id, repo_title, repo_content, repo_show_date, repo_meta_description';
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

	public function getFileList($queryData){
		$this->db->select('repo_file_title, repo_file_name')
				 ->from('recoveries_file')
				 ->where('repo_file_is_del',0,false)
				 ->where('repo_file_status',1,false)
				 ->order_by('repo_file_created_date', 'asc');

		if( isset($queryData['repo_id']) && $queryData['repo_id'] !=''){
			$queryData['repo_id'] = $this->db->escape($queryData['repo_id']);
			$this->db->where('repo_id', $queryData['repo_id'], FALSE);
		}

		$result = $this->db->get();
		$result = $result->result_array();

		return $result;
	}

	public function getRepossessListChapterAndTermsList($queryData, $limit){
		$this->db->select('repossess_list_chapter.repo_list_chapter_id, repo_list_chapter_title, repo_list_terms_content')
				 ->from('repossess_list_chapter')
				 ->join('repossess_list_terms', 'repossess_list_terms.repo_list_chapter_id = repossess_list_chapter.repo_list_chapter_id')
				 ->where('repo_list_chapter_'.$this->is_del,0,false)
				 ->where('repo_list_chapter_'.$this->status,1,false)
				 ->where('repo_list_terms_'.$this->is_del,0,false)
				 ->where('repo_list_terms_'.$this->status,1,false)
				 ->order_by('repo_list_chapter_sort', 'ASC')
				 ->order_by('repo_list_terms_sort', 'ASC');

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

	public function getRepossessListData(){
		$this->db->select('repo_list_content, repo_list_title')
				 ->from('repossess_list')
				 ->where('repo_list_'.$this->is_del,0,false)
				 ->where('repo_list_'.$this->status,1,false)
				 ->where('repo_list_id', 1);

		$rows = $this->db->get();
		return $rows->row_array();
	}

	public function getData($id){
		$this->db->select($this->rowSelect)
				 ->from($this->from)
				 ->where($this->id, $id)
				 ->where($this->abrv.$this->is_del,0,false);
		$rows = $this->db->get();
		return $rows->row_array();
	}

}