<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Members_model extends MY_Model {

	public function __construct(){
		parent::__construct();
		$this->abrv = 'commissioner_';
		$this->from = 'members';
		$this->id = 'commissioner_id';
		$this->listSelect = 'commissioner_name, commissioner_filename, commissioner_education, commissioner_experience, commissioner_is_leader';
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
				 ->where($this->abrv.$this->status,1,false)
				 ->order_by($this->abrv.$this->orderBy, $this->orderType);

		if( isset($queryData['commissioner_is_leader']) ){
			$this->db->where('commissioner_is_leader', $queryData['commissioner_is_leader']);
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

	public function getLeaderData(){
		$this->db->select($this->listSelect)
				 ->from($this->from)
				 ->where($this->abrv.$this->is_del,0,false)
				 ->where($this->abrv.$this->status,1,false)
				 ->where('commissioner_is_leader', 1);

		$rows = $this->db->get();
		return $rows->row_array();
	}

}