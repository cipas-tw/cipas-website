<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact_model extends MY_Model {

	public function __construct(){
		parent::__construct();
		$this->abrv = 'contact_';
		$this->from = 'contact';
		$this->id = 'contact_id';
		$this->listSelect = '*';
		$this->rowSelect = '*';
		$this->orderBy = 'created_date';
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
}