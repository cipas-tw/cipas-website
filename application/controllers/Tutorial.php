<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tutorial extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->unit = '';
	}

	public function index(){
		$data = [];
		$data['unit'] = $this->unit;

		$data['title'] = '網站導覽';
		$data['breadcrumb']['nowPage'] = $data['head']['title'] = $data['title'];

		$data['httpGetParams'] = isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER'] : '';
		$this->showView('/'.$this->controllerName.'/index', $data);
	}

}
