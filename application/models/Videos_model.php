<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Videos_model extends MY_Model {

	public function __construct(){
		parent::__construct();
		$this->abrv = 'video_';
		$this->from = 'videos';
		$this->id = 'video_id';
		$this->listSelect = '*';
		$this->rowSelect = '*';
		$this->orderBy = 'sort';
		$this->orderType = 'ASC';
		/*$this->orderBy = 'show_date';
		$this->orderType = 'DESC';*/
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
				 //->where($this->abrv.'show_date <=', date('Y-m-d'))
				 ->order_by($this->abrv.$this->orderBy, $this->orderType)
				 ->order_by($this->abrv.'show_date', 'DESC')
				 ->order_by($this->abrv.'created_date', 'DESC');

		if( isset($queryData['keyword']) && $queryData['keyword'] !=''){
			$queryData['keyword'] = '%'.$queryData['keyword'].'%';
			$queryData['keyword'] = $this->db->escape(htmlspecialchars($queryData['keyword'], ENT_QUOTES));
			$this->db->where('(`'.$this->abrv.'title` LIKE '. $queryData['keyword'].' or `'.$this->abrv.'content` LIKE '. $queryData['keyword'].')', NULL, FALSE);
		}

		if( isset($queryData['videoType']) && $queryData['videoType'] !=''){
			$queryData['videoType'] = $this->db->escape($queryData['videoType']);
			$this->db->where($this->from.'.video_type_id', $queryData['videoType'], FALSE);
		}

		if( isset($queryData['startDate']) && $queryData['startDate'] !=''){
			$queryData['startDate'] = $this->db->escape($queryData['startDate']);
			$this->db->where('video_created_date >=', $queryData['startDate'], FALSE);
		}

		if( isset($queryData['endDate']) && $queryData['endDate'] !=''){
			$queryData['endDate'] = $this->db->escape($queryData['endDate']);
			$this->db->where('video_created_date <=', $queryData['endDate'], FALSE);
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
		$this->db->select('video_file_title, video_file_name')
				 ->from('videos_file')
				 ->where('video_file_is_del',0,false)
				 ->order_by('video_file_created_date', 'asc');

		if( isset($queryData['video_id']) && $queryData['video_id'] !=''){
			$queryData['video_id'] = $this->db->escape($queryData['video_id']);
			$this->db->where('video_id', $queryData['video_id'], FALSE);
		}

		$result = $this->db->get();
		$result = $result->result_array();

		return $result;
	}
}