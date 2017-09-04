<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OrganicRules_model extends MY_Model {

	public function __construct(){
		parent::__construct();
		$this->abrv = 'org_rules_';
		$this->from = 'organic_rules';
		$this->id = 'org_rules_id';
		$this->listSelect = '*';
		$this->rowSelect = '*';
		$this->orderBy = 'show_date';
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
				 ->where($this->abrv.'show_date <=', date('Y-m-d'))
				 ->order_by($this->abrv.$this->orderBy, $this->orderType)
				 ->order_by($this->abrv.'created_date', 'DESC');

		if( isset($queryData['keyword']) && $queryData['keyword'] !=''){
			$queryData['keyword'] = '%'.$queryData['keyword'].'%';
			$queryData['keyword'] = $this->db->escape(htmlspecialchars($queryData['keyword'], ENT_QUOTES));
			$this->db->where('(`'.$this->abrv.'title` LIKE '. $queryData['keyword'].' or `'.$this->abrv.'content` LIKE '. $queryData['keyword'].')', NULL, FALSE);
		}

		if( isset($queryData['startDate']) && $queryData['startDate'] !=''){
			$queryData['startDate'] = $this->db->escape($queryData['startDate']);
			$this->db->where('org_rules_created_date >=', $queryData['startDate'], FALSE);
		}

		if( isset($queryData['endDate']) && $queryData['endDate'] !=''){
			$queryData['endDate'] = $this->db->escape($queryData['endDate']);
			$this->db->where('org_rules_created_date <=', $queryData['endDate'], FALSE);
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
		$this->db->select('org_rules_file_title, org_rules_file_name')
				 ->from('organic_rules_file')
				 ->where('org_rules_file_is_del',0,false)
				 ->order_by('org_rules_file_created_date', 'asc');

		if( isset($queryData['org_rules_id']) && $queryData['org_rules_id'] !=''){
			$queryData['org_rules_id'] = $this->db->escape($queryData['org_rules_id']);
			$this->db->where('org_rules_id', $queryData['org_rules_id'], FALSE);
		}

		$result = $this->db->get();
		$result = $result->result_array();

		return $result;
	}
}