<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Keywords_model extends MY_Model {

	public function __construct(){
		parent::__construct();
		$this->abrv = 'hot_keyword_';
		$this->from = 'keywords';
		$this->id = 'hot_keyword_id';
		$this->listSelect = '*';
		$this->rowSelect = '*';
		$this->orderBy = 'sort';
		$this->orderType = 'ASC';
		$this->is_del = 'is_del';
		$this->status = 'status';
	}

	public function getList($queryData, $limit){
		$this->db->select($this->listSelect)
				 ->from($this->from)
				 ->where($this->abrv.$this->is_del,0,false)
				 ->where('hot_keyword_title !=""',null,false)
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
}