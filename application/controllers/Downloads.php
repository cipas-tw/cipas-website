<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Downloads extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->unit = '';
	}

	public function index(){
		$this->load->model('Downloads_model');

		$data = [];
		$data['title'] = '檔案下載';
		$data['breadcrumb']['nowPage'] = $data['head']['title'] = $data['title'];

		// 分頁
		$pageConfig = $this->getPageConfig();
		$pageConfig['per_page'] = 10;
		$pageConfig['base_url'] = $this->controllerName.'?';
		$pageConfig['total_rows'] = $this->Downloads_model->getList(false, []);
		$this->pagination->initialize($pageConfig);

		// 取資料
		$data['result'] = $this->Downloads_model->getList(false, array($pageConfig['per_page'], $this->getCurrentPageOffset($pageConfig['per_page'], $pageConfig['total_rows'])));
		$data['path'] = $this->config->item('uploadPath').$this->config->item('filesPath');
		$this->showView('/'.$this->controllerName.'/index', $data);
	}
}
