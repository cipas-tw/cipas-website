<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Declarations extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->unit = '';

		$this->defultImg = $this->config->item('defultImgDoc');
		$this->cropSize = $this->config->item('defultCropSize');
		$this->uploadPath = $this->config->item('uploadPath');
	}

	public function index(){
		$this->load->model('Declarations_model');

		$id = 1;
		$data = [];
		$data['title'] = '申報事項';
		$data['breadcrumb']['nowPage'] = $data['head']['title'] = $data['title'];

		$data['result'] = $this->Declarations_model->getExplainData($id);

		// 分頁
		$pageConfig = $this->getPageConfig();
		$pageConfig['base_url'] = $this->controllerName.'?';
		$pageConfig['total_rows'] = $this->Declarations_model->getList(false, []);
		$this->pagination->initialize($pageConfig);

		// 取資料
		$data['explainList'] = $this->Declarations_model->getList(false, array($pageConfig['per_page'], $this->getCurrentPageOffset($pageConfig['per_page'], $pageConfig['total_rows'])));
		$data['page'] = trim($this->input->get('page', true));
		
		$this->showView('/'.$this->controllerName.'/index', $data);
	}

	public function Detail($id){

		$this->load->model('Declarations_model');

		$data = [];

		$data['result'] = $this->Declarations_model->getData($id);
		if($id =='' || !isset($data['result'])){
			redirect('/'.$this->controllerName);
		}
		$data['resultFile'] = $this->Declarations_model->getFileList(array('declaration_id'=>$id));

		$data['head']['title'] = $data['result']['declaration_title'];
		$data['breadcrumb']['nowPage'] = $data['result']['declaration_title'];
		$data['breadcrumb']['prevPage'] = array('url'=>'/'.$this->controllerName, 'name'=>'申報事項');

		$data['head']['metaTitle'] = rawurlencode(mb_convert_encoding($data['result']['declaration_title'], 'big5', 'utf-8'));
		$data['head']['metaDescription'] = stripslashes($data['result']['declaration_meta_description']);
		$data['head']['metaUrl'] = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
		$data['head']['metaImg'] = '';

		$data['httpGetParams'] = isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER'] : '';
		$data['filePath'] = $this->uploadPath.$this->config->item('declarationPath');
		$this->showView('/'.$this->controllerName.'/detail', $data);
	}
}
