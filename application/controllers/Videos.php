<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class videos extends MY_Controller {
	public function __construct(){
		parent::__construct();

		$this->defultImg = $this->config->item('defultImgDoc');
		$this->uploadPath = $this->config->item('uploadPath');
		$this->cropSize = $this->config->item('defultCropSize');
	}

	public function index(){
		$this->load->model('Videos_model');

		$data = [];
		$data['title'] = '影音專區';
		$data['breadcrumb']['nowPage'] = $data['head']['title'] = $data['title'];

		// 分頁
		$pageConfig = $this->getPageConfig();
		$pageConfig['base_url'] = $this->controllerName.'?';
		$pageConfig['total_rows'] = $this->Videos_model->getList(false, []);
		$this->pagination->initialize($pageConfig);

		// 取資料
		$data['result'] = $this->Videos_model->getList(false, array($pageConfig['per_page'], $this->getCurrentPageOffset($pageConfig['per_page'], $pageConfig['total_rows'])));


// echo "<pre>";print_r($this->db->last_query());echo "</pre>";exit;

		$data['imgPath'] = $this->uploadPath.$this->config->item('videoPath').$this->cropSize[0]['path'];
		$data['filePath'] = $this->uploadPath.$this->config->item('videoPath');

		// 資料整理
		foreach($data['result'] as $k=>$result){
            $date = strtotime($result['video_show_date']);
            $data['result'][$k]['video_show_date'] = date('Y/m/d (', $date).$this->get_chinese_weekday($date).')';
		}
		
		$this->showView('/'.$this->controllerName.'/index', $data);
	}

	public function detail($id){
		$this->load->model('Videos_model');

		$data = [];

		$data['result'] = $this->Videos_model->getData($id);
		if($id =='' || !isset($data['result'])){
			redirect('/'.$this->controllerName);
		}
		$data['resultFile'] = $this->Videos_model->getFileList(array('video_id'=>$id));

		$data['head']['title'] = $data['result']['video_title'];
		$data['head']['title'] = '影音專區-'.$data['result']['video_title'];
		$data['breadcrumb']['nowPage'] = $data['result']['video_title'];
		$data['breadcrumb']['prevPage'] = array('url'=>'/'.$this->controllerName, 'name'=>'影音專區');

		$data['head']['metaTitle'] = rawurlencode(mb_convert_encoding($data['result']['video_title'], 'big5', 'utf-8'));
		$data['head']['metaDescription'] = stripslashes($data['result']['video_meta_description']);
		$data['head']['metaUrl'] = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
		$data['head']['metaImg'] = '';

		$data['httpGetParams'] = isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER'] : '';
		$data['imgPath'] = $this->uploadPath.$this->config->item('videoPath').$this->cropSize[0]['path'];
		$data['filePath'] = $this->uploadPath.$this->config->item('videoPath');
		$this->showView('/'.$this->controllerName.'/detail', $data);
	}
}
