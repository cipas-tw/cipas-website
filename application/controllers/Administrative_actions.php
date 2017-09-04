<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrative_actions extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->unit = '';

		$this->load->model('AdministrativeActions_model');

		$this->defultImg = $this->config->item('defultImgDoc');
		$this->cropSize = $this->config->item('defultCropSize');
		$this->uploadPath = $this->config->item('uploadPath');
	}

	public function index(){
		
		$data = [];
		$data['title'] = '行政處分';
		$data['abrv'] = 'adm_act_';
		$data['name'] = 'administrativeact';
		$data['breadcrumb']['nowPage'] = $data['head']['title'] = $data['title'];

		// 分頁
		$pageConfig = $this->getPageConfig();
		$pageConfig['base_url'] = $this->controllerName.'?';
		$pageConfig['total_rows'] = $this->AdministrativeActions_model->getList(false, []);
		$this->pagination->initialize($pageConfig);

		// 取資料
		$data['result'] = $this->AdministrativeActions_model->getList(false, array($pageConfig['per_page'], $this->getCurrentPageOffset($pageConfig['per_page'], $pageConfig['total_rows'])));
		$data['imgPath'] = $this->uploadPath.$this->config->item('administrativeActPath').$this->cropSize[1]['path'];
		$data['defultImgCipas'] = $this->defultImg;
		$this->showView('/schedule/index', $data);
	}

	public function detail($id){

		$data = [];

		$data['result'] = $this->AdministrativeActions_model->getData($id);
		if($id =='' || !isset($data['result'])){
			redirect('/'.$this->controllerName);
		}
		$data['resultNote'] = $this->AdministrativeActions_model->getNoteList(array('adm_act_id'=>$id));

		$data['abrv'] = 'adm_act_';
		$data['name'] = 'administrativeact';
		$data['title'] = $data['result']['adm_act_title'];

		$data['head']['title'] = '行政處分-'.$data['result']['adm_act_title'];
		$data['breadcrumb']['nowPage'] = $data['result']['adm_act_title'];
		$data['breadcrumb']['prevPage'] = array('url'=>'/'.$this->controllerName, 'name'=>'行政處分');

		$data['head']['metaTitle'] = rawurlencode(mb_convert_encoding($data['result']['adm_act_title'], 'big5', 'utf-8'));
		$data['head']['metaDescription'] = stripslashes($data['result']['adm_act_meta_description']);
		$data['head']['metaUrl'] = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
		$data['head']['metaImg'] = '';

		$data['httpGetParams'] = isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER'] : '';

		$this->showView('/schedule/detail', $data);
	}
}
