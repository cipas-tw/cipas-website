<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchases_model extends MY_Model {

	public function __construct(){
		parent::__construct();
		$this->abrv = 'purchase_';
		$this->from = 'purchases';
		$this->id = 'purchase_id';
		$this->listSelect = 'purchase_id, purchase_title, purchase_content, purchase_show_date, purchase_meta_description';
		$this->rowSelect = 'purchase_id, purchase_title, purchase_content, purchase_show_date, purchase_meta_description';
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

	public function getData($id){
		$this->db->select($this->rowSelect)
				 ->from($this->from)
				 ->where($this->id, $id)
				 ->where($this->abrv.$this->is_del,0,false);
		$rows = $this->db->get();
		return $rows->row_array();
	}

	public function getFileList($queryData){
		$this->db->select('purchase_file_title, purchase_file_name')
				 ->from('purchases_file')
				 ->where('purchase_file_is_del',0,false)
				 ->where('purchase_file_status',1,false)
				 ->order_by('purchase_file_created_date', 'asc');

		if( isset($queryData['purchase_id']) && $queryData['purchase_id'] !=''){
			$queryData['purchase_id'] = $this->db->escape($queryData['purchase_id']);
			$this->db->where('purchase_id', $queryData['purchase_id'], FALSE);
		}

		$result = $this->db->get();
		$result = $result->result_array();

		return $result;
	}

}