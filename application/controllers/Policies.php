<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Policies extends MY_Controller {
	public function __construct(){
		parent::__construct();

		$this->defultImg = $this->config->item('defultImgDoc');
		$this->uploadPath = $this->config->item('uploadPath');
		$this->cropSize = $this->config->item('defultCropSize');
		$this->load->model('Policies_model');
	}

	public function index(){
		

		$data = [];
		$data['abrv'] = 'policy_';
		$data['title'] = '施政計畫';
		$data['breadcrumb']['nowPage'] = $data['head']['title'] = $data['title'];

		// 分頁
		$pageConfig = $this->getPageConfig();
		$pageConfig['base_url'] = $this->controllerName.'?';
		$pageConfig['total_rows'] = $this->Policies_model->getList(false, []);
		$this->pagination->initialize($pageConfig);
		$data['result'] = $this->Policies_model->getList(false, array($pageConfig['per_page'], $this->getCurrentPageOffset($pageConfig['per_page'], $pageConfig['total_rows'])));
		$data['httpGetParams'] = isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER'] : '';
		
		$this->showView('/'.$this->controllerName.'/index', $data);
	}
	
	public function detail($id){
		
		$data = [];
		$data['result'] = $this->Policies_model->getData($id);

		if( $id =='' || !isset($data['result']) ){
			redirect('/'.$this->controllerName);
		}
		$data['resultFile'] = $this->Policies_model->getFileList(array('policy_id'=>$id));
		$data['head']['metaTitle'] = rawurlencode(mb_convert_encoding($data['result']['policy_title'], 'big5', 'utf-8'));
		$data['head']['metaDescription'] = stripslashes($data['result']['policy_meta_description']);
		$data['head']['metaUrl'] = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
		$data['head']['metaImg'] = '';

		$data['head']['title'] = '施政計畫-'.$data['result']['policy_title'];
		$data['breadcrumb']['nowPage'] = $data['result']['policy_title'];
		$data['breadcrumb']['prevPage'] = array('url'=>'/'.$this->controllerName, 'name'=>'施政計畫');
		$data['filePath'] = $this->config->item('uploadPath').$this->config->item('policyPath');

		$data['httpGetParams'] = isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER'] : '';
		$this->showView('/'.$this->controllerName.'/detail', $data);
	}
}
