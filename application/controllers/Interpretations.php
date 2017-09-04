<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Interpretations extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->unit = '';

		$this->defultImg = $this->config->item('defultImgDoc');
		$this->cropSize = $this->config->item('defultCropSize');
		$this->uploadPath = $this->config->item('uploadPath');
	}

	public function index(){
		$this->load->model('Interpretations_model');
		$data = [];
		$data['head']['title'] = '本會解釋';
		$data['breadcrumb']['nowPage'] = $data['head']['title'];

		// 分頁
		$pageConfig = $this->getPageConfig();
		$pageConfig['base_url'] = $this->controllerName.'?';
		$pageConfig['total_rows'] = $this->Interpretations_model->getList(false, []);
		$this->pagination->initialize($pageConfig);
		$data['result'] = $this->Interpretations_model->getList(false, array($pageConfig['per_page'], $this->getCurrentPageOffset($pageConfig['per_page'], $pageConfig['total_rows'])));
		$data['httpGetParams'] = isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER'] : '';
		$this->showView('/'.$this->controllerName.'/index', $data);
	}

	public function detail($id){
		$this->load->model('Interpretations_model');
		$data = [];
		$data['result'] = $this->Interpretations_model->getData($id);

		if( $id =='' || !isset($data['result']) ){
			redirect('/'.$this->controllerName);
		}
		$data['resultFile'] = $this->Interpretations_model->getFileList(array('rule_id'=>$id));
		$data['head']['metaTitle'] = rawurlencode(mb_convert_encoding($data['result']['rule_title'], 'big5', 'utf-8'));
		$data['head']['metaDescription'] = stripslashes($data['result']['rule_meta_description']);
		$data['head']['metaUrl'] = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
		$data['head']['metaImg'] = '';

		$data['head']['title'] = '本會解釋-'.$data['result']['rule_title'];
		$data['breadcrumb']['nowPage'] = $data['result']['rule_title'];
		$data['breadcrumb']['prevPage'] = array('url'=>'/'.$this->controllerName, 'name'=>'本會解釋');
		$data['filePath'] = $this->config->item('uploadPath').$this->config->item('rulePath');

		$data['httpGetParams'] = isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER'] : '';
		$this->showView('/'.$this->controllerName.'/detail', $data);
	}
}
