<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Articles_model extends MY_Model {

	public function __construct(){
		parent::__construct();
		$this->abrv = 'news_';
		$this->from = 'articles';
		$this->id = 'news_id';
		$this->listSelect = $this->from.'.*';
		$this->rowSelect = $this->from.'.*';
		//$this->orderBy = 'show_date';
		$this->orderBy = 'sort';
		$this->orderType = 'ASC';
		//$this->orderType = 'DESC';
		$this->is_del = 'is_del';
		$this->status = 'status';
	}

	public function getData($id){
		$this->db->select($this->rowSelect.', news_type_name')
				 ->from($this->from)
				 ->join('articles_type', 'articles_type.news_type_id = articles.news_type_id')
				 ->where($this->id, $id)
				 ->where($this->abrv.$this->is_del,0,false);
		$rows = $this->db->get();
		return $rows->row_array();
	}

	public function getList($queryData, $limit){
		$this->db->select($this->listSelect.', news_type_name')
				 ->from($this->from)
				 ->join('articles_type', 'articles_type.news_type_id = articles.news_type_id')
				 ->where($this->abrv.$this->is_del,0,false)
				 ->where($this->abrv.$this->status,1,false)
				 ->where($this->abrv.'show_date <=', date('Y-m-d'))
				 ->order_by($this->abrv.$this->orderBy, $this->orderType)
				 ->order_by($this->abrv.'show_date', 'DESC')
				 ->order_by($this->abrv.'created_date', 'DESC');


		if( isset($queryData['keyword']) && $queryData['keyword'] !=''){
			$queryData['keyword'] = '%'.$queryData['keyword'].'%';
			$queryData['keyword'] = $this->db->escape(htmlspecialchars($queryData['keyword'], ENT_QUOTES));
			$this->db->where('(`'.$this->abrv.'title` LIKE '. $queryData['keyword'].' or `'.$this->abrv.'content` LIKE '. $queryData['keyword'].')', NULL, FALSE);
		}

		if( isset($queryData['newsType']) && $queryData['newsType'] !=''){
			$queryData['newsType'] = $this->db->escape($queryData['newsType']);
			$this->db->where($this->from.'.news_type_id', $queryData['newsType'], FALSE);
		}

		if( isset($queryData['startDate']) && $queryData['startDate'] !=''){
			$queryData['startDate'] = $this->db->escape($queryData['startDate']);
			$this->db->where('news_created_date >=', $queryData['startDate'], FALSE);
		}

		if( isset($queryData['endDate']) && $queryData['endDate'] !=''){
			$queryData['endDate'] = $this->db->escape($queryData['endDate']);
			$this->db->where('news_created_date <=', $queryData['endDate'], FALSE);
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
		$this->db->select('news_file_title, news_file_name')
				 ->from('articles_file')
				 ->where('news_file_is_del',0,false)
				 ->order_by('news_file_created_date', 'asc');

		if( isset($queryData['news_id']) && $queryData['news_id'] !=''){
			$queryData['news_id'] = $this->db->escape($queryData['news_id']);
			$this->db->where('news_id', $queryData['news_id'], FALSE);
		}

		$result = $this->db->get();
		$result = $result->result_array();

		return $result;
	}

	public function getNewsTypeList(){
		$this->db->from('articles_type')
				 ->where('news_type_is_del',0,false)
				 ->order_by('news_type_created_date', 'asc');

		$result = $this->db->get();
		$result = $result->result_array();

		return $result;
	}

	public function getNewsTypeData($id){
		$id = $this->db->escape_str($id);
		$this->db->from('articles_type')
				 ->where('news_type_is_del',0,false)
				 ->where('news_type_id', $id);

		$rows = $this->db->get();
		return $rows->row_array();
	}
}