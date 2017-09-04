<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Budgets extends MY_Controller {
	public function __construct(){
		parent::__construct();

		$this->defultImg = $this->config->item('defultImgDoc');
		$this->uploadPath = $this->config->item('uploadPath');
		$this->cropSize = $this->config->item('defultCropSize');
	}

	public function index(){
		$this->load->model('Budgets_model');

		$data = [];
		$data['abrv'] = 'budget_';
		$data['title'] = '預算書及決算書';
		$data['breadcrumb']['nowPage'] = $data['head']['title'] = $data['title'];

		// 分頁
		$pageConfig = $this->getPageConfig();
		$pageConfig['per_page'] = 10;
		$pageConfig['base_url'] = $this->controllerName.'?';
		$pageConfig['total_rows'] = $this->Budgets_model->getList(false, []);
		$this->pagination->initialize($pageConfig);

		// 取資料
		$data['result'] = $this->Budgets_model->getList(false, array($pageConfig['per_page'], $this->getCurrentPageOffset($pageConfig['per_page'], $pageConfig['total_rows'])));
		$data['path'] = $this->uploadPath.$this->config->item('budgetPath');
		$this->showView('/information/index', $data);
	}
}
