<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->unit = '';

		$this->load->model('Articles_model', 'models');

		$this->defultImgCipas = $this->config->item('defultImgCipas');
		$this->cropSize = $this->config->item('defultCropSize');
		$this->uploadPath = $this->config->item('uploadPath');
		$this->path = $this->uploadPath.$this->config->item('newsPath');
	}

	public function index(){
		$data = $queryData = [];

		// 分頁
		$httpGetParams = $this->combineGetParams($queryData);

		// $queryData['newsType'] = $newsType;

		// // 檢查分類是否存在
		// if(isset($queryData['newsType']) && $queryData['newsType'] !=''){
		// 	$newsTypeData = $this->models->getNewsTypeData($queryData['newsType']);
		// 	if(!isset($newsTypeData)){
		// 		redirect('/'.$this->controllerName.'/');
		// 	}
		// }

		//$data['title'] = isset($newsTypeData)? $newsTypeData['news_type_name'] : '最新消息';
		$data['title'] = '最新消息';
		$data['breadcrumb']['nowPage'] = $data['head']['title'] = $data['title'];

		$data['head']['metaDescription'] = '';
		$data['head']['metaUrl'] = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
		$data['head']['metaImg'] = '';

		$pageConfig = $this->getPageConfig();
		$pageConfig['base_url'] = $this->controllerName.'?';
		$pageConfig['total_rows'] = $this->models->getList($queryData, NULL);
		$this->pagination->initialize($pageConfig);

		// 取資料
		$data['result'] = $this->models->getList($queryData, array($pageConfig['per_page'], $this->getCurrentPageOffset($pageConfig['per_page'], $pageConfig['total_rows'])));

		// 資料整理
		foreach($data['result'] as $k=>$result){
            $date = strtotime($result['news_show_date']);
            $data['result'][$k]['news_show_date'] = date('Y/m/d (', $date).$this->get_chinese_weekday($date).')';
		}

		$data['httpGetParams'] = isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER'] : '';
		$data['imgPath'] = $this->path.$this->cropSize[1]['path'];
		$data['defultImgCipas'] = $this->defultImgCipas;
		$this->showView('/'.$this->controllerName.'/index', $data);
	}

	public function detail($id){


		$data = [];

		$data['result'] = $this->models->getData($id);
		if($id =='' || !isset($data['result'])){
			redirect('/'.$this->controllerName);
		}
		$data['resultFile'] = $this->models->getFileList(array('news_id'=>$id));

		$data['head']['title'] = $data['result']['news_title'];

		// 檢查分類是否存在
		// if(isset($queryData['newsType']) && $queryData['newsType'] !=''){
		// 	$newsTypeData = $this->models->getNewsTypeData($queryData['newsType']);
		// 	if(!isset($newsTypeData)){
		// 		redirect('/'.$this->controllerName.'/');
		// 	}
		// }

		$data['head']['title'] = $data['result']['news_type_name'].'-'.$data['result']['news_title'];
		$data['breadcrumb']['nowPage'] = $data['result']['news_title'];
		$data['breadcrumb']['prevPage'] = array('url'=>'/'.$this->controllerName, 'name'=>$data['result']['news_type_name']);

		$data['head']['metaTitle'] = rawurlencode(mb_convert_encoding($data['result']['news_title'], 'big5', 'utf-8'));
		$data['head']['metaUrl'] = $this->config->item('metaUrl');
		$data['head']['metaDescription'] = stripslashes($data['result']['news_meta_description']);
		$data['head']['metaImg'] = isset($data['result']['news_filename'])? $this->path.$this->cropSize[0]['path'].$data['result']['news_filename'] : '';

		$data['httpGetParams'] = isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER'] : '';

		$data['imgPath'] = $this->path.$this->cropSize[0]['path'];
		$data['filePath'] = $this->path;
		$this->showView('/'.$this->controllerName.'/detail', $data);
	}
}
