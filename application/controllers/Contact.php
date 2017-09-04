<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->unit = '';
		$this->load->model('Contact_model');
		$this->contactId = 1;
	}

	public function index(){
		$id = $this->contactId;
		$data = [];
		$data['head']['title'] = '聯絡資訊';
		$data['breadcrumb']['nowPage'] = $data['head']['title'];
		$data['result'] = $this->Contact_model->getData($id);
		$data['httpGetParams'] = isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER'] : '';
		$this->showView('/'.$this->controllerName.'/index', $data);
	}
}
