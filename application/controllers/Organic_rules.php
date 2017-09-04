<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Organic_rules extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->unit = '';

		$this->defultImg = $this->config->item('defultImgDoc');
		$this->cropSize = $this->config->item('defultCropSize');
		$this->uploadPath = $this->config->item('uploadPath');
	}

	public function index(){
		$this->load->model('OrganicRules_model');
		$filePath = $this->config->item('newsPath');

		$data = [];
		$data['title'] = '組織規程';
		$data['breadcrumb']['nowPage'] = $data['head']['title'] = $data['title'];

		// 分頁
		$pageConfig = $this->getPageConfig();
		$pageConfig['base_url'] = $this->controllerName.'?';
		$pageConfig['total_rows'] = $this->OrganicRules_model->getList(false, []);
		$this->pagination->initialize($pageConfig);

		// 取資料
		$data['result'] = $this->OrganicRules_model->getList(false, array($pageConfig['per_page'], $this->getCurrentPageOffset($pageConfig['per_page'], $pageConfig['total_rows'])));

		$data['imgPath'] = $this->uploadPath.$this->config->item('orgRulesPath').$this->cropSize[1]['path'];
		$data['defultImg'] = $this->defultImg;
		$this->showView('/'.$this->controllerName.'/index', $data);
	}

	public function detail($id){
		$this->load->model('OrganicRules_model');
		$filePath = $this->config->item('orgRulesPath');

		$data = [];

		$data['result'] = $this->OrganicRules_model->getData($id);
		if($id =='' || !isset($data['result'])){
			redirect('/'.$this->controllerName);
		}

		$data['resultFile'] = $this->OrganicRules_model->getFileList(array('org_rules_id'=>$id));
		$data['head']['title'] = $data['result']['org_rules_title'];

		$data['head']['title'] = '組織規程-'.$data['result']['org_rules_title'];
		$data['breadcrumb']['nowPage'] = $data['result']['org_rules_title'];
		// $data['breadcrumb']['prevPage'] = array('url'=>'/'.$this->controllerName, 'name'=>'組織規程');

		$data['head']['metaTitle'] = rawurlencode(mb_convert_encoding($data['result']['org_rules_title'], 'big5', 'utf-8'));
		$data['head']['metaDescription'] = stripslashes($data['result']['org_rules_meta_description']);
		$data['head']['metaUrl'] = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
		$data['head']['metaImg'] = '';

		$data['httpGetParams'] = isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER'] : '';
		$data['imgPath'] = $this->uploadPath.$this->config->item('orgRulesPath').$this->cropSize[1]['path'];
		$data['filePath'] = $this->uploadPath.$this->config->item('orgRulesPath');
		$this->showView('/'.$this->controllerName.'/detail', $data);
	}
}
