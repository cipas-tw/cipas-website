<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Litigations extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->unit = '';

		$this->defultImg = $this->config->item('defultImgDoc');
		$this->cropSize = $this->config->item('defultCropSize');
		$this->uploadPath = $this->config->item('uploadPath');
	}

	public function index(){
		$this->load->model('Litigations_model');

		$data = [];
		$data['title'] = '相關訴訟';
		$data['abrv'] = 'litigation_';
		$data['name'] = 'litigation';
		$data['breadcrumb']['nowPage'] = $data['head']['title'] = $data['title'];

		// 分頁
		$pageConfig = $this->getPageConfig();
		$pageConfig['base_url'] = $this->controllerName.'?';
		$pageConfig['total_rows'] = $this->Litigations_model->getList(false, []);
		$this->pagination->initialize($pageConfig);

		// 取資料
		$data['result'] = $this->Litigations_model->getList(false, array($pageConfig['per_page'], $this->getCurrentPageOffset($pageConfig['per_page'], $pageConfig['total_rows'])));

		$data['imgPath'] = $this->uploadPath.$this->config->item('litigationPath').$this->cropSize[1]['path'];
		$data['defultImgCipas'] = $this->defultImg;
		$this->showView('/schedule/index', $data);
	}

	public function Detail($id){

		$this->load->model('Litigations_model');

		$data = [];

		$data['result'] = $this->Litigations_model->getData($id);
		if($id =='' || !isset($data['result'])){
			redirect('/'.$this->controllerName);
		}
		$data['resultNote'] = $this->Litigations_model->getNoteList(array('litigation_id'=>$id));
		$data['resultFile'] = $this->Litigations_model->getFileList(array('litigation_id'=>$id));

		$data['abrv'] = 'litigation_';
		$data['name'] = 'litigation';
		$data['title'] = $data['result']['litigation_title'];

		$data['head']['title'] = '相關訴訟-'.$data['result']['litigation_title'];
		$data['breadcrumb']['nowPage'] = $data['result']['litigation_title'];
		$data['breadcrumb']['prevPage'] = array('url'=>'/'.$this->controllerName, 'name'=>'相關訴訟');

		$data['head']['metaTitle'] = rawurlencode(mb_convert_encoding($data['result']['litigation_title'], 'big5', 'utf-8'));
		$data['head']['metaDescription'] = stripslashes($data['result']['litigation_meta_description']);
		$data['head']['metaUrl'] = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
		$data['head']['metaImg'] = '';

		$data['filePath'] = $this->uploadPath.$this->config->item('litigationPath');
		$data['httpGetParams'] = isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER'] : '';

		$this->showView('/schedule/detail', $data);
	}
}
