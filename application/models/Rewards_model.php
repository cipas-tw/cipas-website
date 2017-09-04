<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rewards_model extends MY_Model {

	public function __construct(){
		parent::__construct();
		$this->abrv = 'reward_';
		$this->from = 'rewards';
		$this->id = 'reward_id';
		$this->listSelect = 'reward_id, reward_title, reward_content, reward_show_date, reward_meta_description';
		$this->rowSelect = 'reward_title, reward_content, reward_show_date, reward_meta_description';
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
		$this->db->select('reward_file_title, reward_file_name')
				 ->from('rewards_file')
				 ->where('reward_file_is_del',0,false)
				 ->where('reward_file_status',1,false)
				 ->order_by('reward_file_created_date', 'asc');

		if( isset($queryData['reward_id']) && $queryData['reward_id'] !=''){
			$queryData['reward_id'] = $this->db->escape($queryData['reward_id']);
			$this->db->where('reward_id', $queryData['reward_id'], FALSE);
		}

		$result = $this->db->get();
		$result = $result->result_array();

		return $result;
	}

	public function getRewardListChapterAndTermsList($queryData, $limit){
		$this->db->select('reward_list_chapter.reward_list_chapter_id, reward_list_chapter_title, reward_list_terms_content')
				 ->from('reward_list_chapter')
				 ->join('reward_list_terms', 'reward_list_terms.reward_list_chapter_id = reward_list_chapter.reward_list_chapter_id')
				 ->where('reward_list_chapter_'.$this->is_del,0,false)
				 ->where('reward_list_chapter_'.$this->status,1,false)
				 ->where('reward_list_terms_'.$this->is_del,0,false)
				 ->where('reward_list_terms_'.$this->status,1,false)
				 ->order_by('reward_list_chapter_sort', 'ASC')
				 ->order_by('reward_list_terms_sort', 'ASC');

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

	public function getRewardListData(){
		$this->db->select('reward_list_content, reward_list_title')
				 ->from('reward_list')
				 ->where('reward_list_'.$this->is_del,0,false)
				 ->where('reward_list_'.$this->status,1,false)
				 ->where('reward_list_id', 1);

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