<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stories extends MY_Controller {
	public function __construct(){
		parent::__construct();

		$this->defultImg = $this->config->item('defultImgDoc');
		$this->uploadPath = $this->config->item('uploadPath');
		$this->cropSize = $this->config->item('defultCropSize');
		$this->path = $this->uploadPath.$this->config->item('historyStoryPath');
	}

	public function index(){
		$this->load->model('Stories_model');

		$data = [];
		$data['title'] = '史料故事';
		$data['breadcrumb']['nowPage'] = $data['head']['title'] = $data['title'];

		// 分頁
		$pageConfig = $this->getPageConfig();
		$pageConfig['base_url'] = $this->controllerName.'?';
		$pageConfig['total_rows'] = $this->Stories_model->getList(false, []);
		$this->pagination->initialize($pageConfig);

		// 取資料
		$data['result'] = $this->Stories_model->getList(false, array($pageConfig['per_page'], $this->getCurrentPageOffset($pageConfig['per_page'], $pageConfig['total_rows'])));
		$data['imgPath'] = $this->path.$this->cropSize[1]['path'];
		$data['defultImg'] = $this->defultImg;
		$this->showView('/'.$this->controllerName.'/index', $data);
	}

	public function detail($id){
		$this->load->model('Stories_model');

		$data = [];

		$data['result'] = $this->Stories_model->getData($id);
		if($id =='' || !isset($data['result'])){
			redirect('/'.$this->controllerName);
		}
		$data['resultFile'] = $this->Stories_model->getFileList(array('history_story_id'=>$id));

		$data['head']['title'] = '史料故事-'.$data['result']['history_story_title'];
		$data['breadcrumb']['nowPage'] = $data['result']['history_story_title'];
		$data['breadcrumb']['prevPage'] = array('url'=>'/'.$this->controllerName, 'name'=>'史料故事');

		$data['head']['metaTitle'] = rawurlencode(mb_convert_encoding($data['result']['history_story_title'], 'big5', 'utf-8'));
		$data['head']['metaDescription'] = stripslashes($data['result']['history_story_meta_description']);
		$data['head']['metaUrl'] = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
		$data['head']['metaImg'] = '';

		$data['httpGetParams'] = isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER'] : '';
		$data['imgPath'] = $this->path.$this->cropSize[0]['path'];
		$data['filePath'] = $this->path;
		$data['defultImg'] = $this->defultImg;
		$this->showView('/'.$this->controllerName.'/detail', $data);
	}
}
