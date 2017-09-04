<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Downloads_model extends MY_Model {

	public function __construct(){
		parent::__construct();
		$this->abrv = 'files_';
		$this->from = 'downloads';
		$this->id = 'files_id';
		$this->listSelect = '*';
		$this->rowSelect = '*';
		
		//$this->orderBy = 'created_date';
		//$this->orderType = 'DESC';
		$this->orderBy = 'sort';
		$this->orderType = 'ASC';

		$this->is_del = 'is_del';
		$this->status = 'status';
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

}