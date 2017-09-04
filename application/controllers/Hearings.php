<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hearings extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->unit = '';

		$this->defultImg = $this->config->item('defultImgDoc');
		$this->cropSize = $this->config->item('defultCropSize');
		$this->uploadPath = $this->config->item('uploadPath');
	}

	public function index(){
		$this->load->model('Hearings_model');

		$data = [];
		$data['title'] = '聽證程序';
		$data['abrv'] = 'hearing_';
		$data['name'] = 'hearing';
		$data['breadcrumb']['nowPage'] = $data['head']['title'] = $data['title'];

		// 分頁
		$pageConfig = $this->getPageConfig();
		$pageConfig['base_url'] = $this->controllerName.'?';
		$pageConfig['total_rows'] = $this->Hearings_model->getList(false, []);
		$this->pagination->initialize($pageConfig);

		// 取資料
		$data['result'] = $this->Hearings_model->getList(false, array($pageConfig['per_page'], $this->getCurrentPageOffset($pageConfig['per_page'], $pageConfig['total_rows'])));

		$data['imgPath'] = $this->uploadPath.$this->config->item('hearingPath').$this->cropSize[1]['path'];
		$data['defultImgCipas'] = $this->defultImg;
		$this->showView('/schedule/index', $data);
	}

	public function Detail($id){

		$this->load->model('Hearings_model');

		$data = [];

		$data['result'] = $this->Hearings_model->getData($id);
		if($id =='' || !isset($data['result'])){
			redirect('/'.$this->controllerName);
		}
		$data['resultNote'] = $this->Hearings_model->getNoteList(array('hearing_id'=>$id));

		$data['abrv'] = 'hearing_';
		$data['name'] = 'hearing';
		$data['title'] = $data['result']['hearing_title'];

		$data['head']['title'] = '聽證程序-'.$data['result']['hearing_title'];
		$data['breadcrumb']['nowPage'] = $data['result']['hearing_title'];
		$data['breadcrumb']['prevPage'] = array('url'=>'/'.$this->controllerName, 'name'=>'聽證程序');

		$data['head']['metaTitle'] = rawurlencode(mb_convert_encoding($data['result']['hearing_title'], 'big5', 'utf-8'));
		$data['head']['metaDescription'] = stripslashes($data['result']['hearing_meta_description']);
		$data['head']['metaUrl'] = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
		$data['head']['metaImg'] = '';

		$data['httpGetParams'] = isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER'] : '';

		$this->showView('/schedule/detail', $data);
	}
}
