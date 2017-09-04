<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Regulations extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->unit = '';

		$this->defultImg = $this->config->item('defultImgDoc');
		$this->cropSize = $this->config->item('defultCropSize');
		$this->uploadPath = $this->config->item('uploadPath');
	}

	public function index(){
		$this->load->model('Regulations_model');
		$data = [];
		$data['head']['title'] = '本會主管法規';
		$data['breadcrumb']['nowPage'] = $data['head']['title'];

		// 分頁
		$pageConfig = $this->getPageConfig();
		$pageConfig['base_url'] = $this->controllerName.'?';
		$pageConfig['total_rows'] = $this->Regulations_model->getList(false, []);
		$this->pagination->initialize($pageConfig);
		$data['result'] = $this->Regulations_model->getList(false, array($pageConfig['per_page'], $this->getCurrentPageOffset($pageConfig['per_page'], $pageConfig['total_rows'])));
		$data['httpGetParams'] = isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER'] : '';

		$this->showView('/'.$this->controllerName.'/index', $data);
	}

	public function detail($id){
		$this->load->model('Regulations_model');
		$data = [];
		$data['result'] = $this->Regulations_model->getData($id);
		if( $id =='' || !isset($data['result']) ){
			redirect('/'.$this->controllerName);
		}
		$data['resultFile'] = $this->Regulations_model->getFileList(array('law_id'=>$id));

		$data['resultList'] = [];
		$termsList = $this->Regulations_model->getTermsList($id);

		$numberingIsNull = false;
		foreach($termsList as $val){
			if(!isset($data['resultList'][$val['law_chapter_id']])){
				$data['resultList'][$val['law_chapter_id']]['chapter_title'] = $val['law_chapter_title'];
				$data['resultList'][$val['law_chapter_id']]['list'] = [];
				$data['resultList'][$val['law_chapter_id']]['numbering'] = [];
			}
			$data['resultList'][$val['law_chapter_id']]['list'][] = $val['law_terms_content'];
			$data['resultList'][$val['law_chapter_id']]['numbering'][] = $val['law_terms_numbering'];
			$numberingIsNull = $val['law_terms_numbering'] == '' || $val['law_terms_numbering'] == null ? true : false;
		}
		if($numberingIsNull){
			$data['resultList'][$val['law_chapter_id']]['numbering'] = [];
		}

		$data['head']['metaTitle'] = rawurlencode(mb_convert_encoding($data['result']['law_title'], 'big5', 'utf-8'));
		$data['head']['metaDescription'] = stripslashes($data['result']['law_meta_description']);
		$data['head']['metaUrl'] = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
		$data['head']['metaImg'] = '';

		$data['head']['title'] = '本會主管法規-'.$data['result']['law_title'];
		$data['breadcrumb']['nowPage'] = $data['result']['law_title'];
		$data['breadcrumb']['prevPage'] = array('url'=>'/'.$this->controllerName, 'name'=>'本會主管法規');

		$data['filePath'] = $this->config->item('uploadPath').$this->config->item('lawPath');
		$data['httpGetParams'] = isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER'] : '';
		$this->showView('/'.$this->controllerName.'/detail', $data);
	}
}
