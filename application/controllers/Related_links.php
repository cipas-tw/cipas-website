<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Related_links extends MY_Controller {
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$this->load->model('Related_links_model');

		$data = [];
		$data['title'] = '相關連結';
		$data['breadcrumb']['nowPage'] = $data['head']['title'] = $data['title'];

		// 分頁
		$pageConfig = $this->getPageConfig();
		$pageConfig['per_page'] = 10;
		$pageConfig['base_url'] = $this->controllerName.'?';
		$pageConfig['total_rows'] = $this->Related_links_model->getList(false, []);
		$this->pagination->initialize($pageConfig);

		// 取資料
		$data['result'] = $this->Related_links_model->getList(false, array($pageConfig['per_page'], $this->getCurrentPageOffset($pageConfig['per_page'], $pageConfig['total_rows'])));
		$this->showView('/'.$this->controllerName.'/index', $data);
	}
}
