<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class License extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->unit = '';

	}

	public function index(){
		$data = [];
		$data['unit'] = $this->unit;

		$data['title'] = '政府網站資料開放宣告';
		$data['breadcrumb']['nowPage'] = $data['head']['title'] = $data['title'];

		$data['httpGetParams'] = isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER'] : '';
		$this->showView('/'.$this->controllerName.'/index', $data);
	}

}
