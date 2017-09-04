<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->unit = '';
	}

	public function index(){
		$this->load->model('Questions_model');
		$data = [];
		$data['head']['title'] = '常見問題';
		$data['breadcrumb']['nowPage'] = $data['head']['title'];

		$data['head']['metaTitle'] = rawurlencode(mb_convert_encoding('常見問題', 'big5', 'utf-8'));
		$data['head']['metaDescription'] = '';
		$data['head']['metaUrl'] = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
		$data['head']['metaImg'] = '';

		// 分頁
		$pageConfig = $this->getPageConfig();
		$pageConfig['base_url'] = $this->controllerName.'?';
		$pageConfig['total_rows'] = $this->Questions_model->getList(false, []);
		$this->pagination->initialize($pageConfig);
		$data['result'] = $this->Questions_model->getList(false, array($pageConfig['per_page'], $this->getCurrentPageOffset($pageConfig['per_page'], $pageConfig['total_rows'])));
		$data['httpGetParams'] = isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER'] : '';
		$this->showView('/'.$this->controllerName.'/index', $data);
	}
}
