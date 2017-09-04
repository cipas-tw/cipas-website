<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Collect extends MY_Controller {
	public function __construct(){
		parent::__construct();

		$this->defultImg = $this->config->item('defultImgDoc');
		$this->uploadPath = $this->config->item('uploadPath');
		$this->cropSize = $this->config->item('defultCropSize');
		$this->path = $this->uploadPath.$this->config->item('historyStoryPath');
	}

	public function index(){
		$this->load->model('Collect_model');

		$data = [];
		$id = 1;

		$data['result'] = $this->Collect_model->getData($id);
		$data['result']['collect_plan_content'] = stripslashes($data['result']['collect_plan_content']);
		if($id =='' || !isset($data['result'])){
			redirect('/'.$this->controllerName);
		}
		$data['resultFile'] = $this->Collect_model->getFileList(array('collect_plan_id'=>$id));

		$data['head']['title'] = '史料徵集說明-'.$data['result']['collect_plan_title'];
		$data['title'] = $data['breadcrumb']['nowPage'] = '史料徵集說明';

		$data['head']['metaTitle'] = rawurlencode(mb_convert_encoding($data['result']['collect_plan_title'], 'big5', 'utf-8'));
		$data['head']['metaDescription'] = stripslashes($data['result']['collect_plan_meta_description']);
		$data['head']['metaUrl'] = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
		$data['head']['metaImg'] = '';

		$data['httpGetParams'] = isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER'] : '';
		$data['filePath'] = $this->uploadPath.$this->config->item('collectPlanPath');
		$this->showView('/'.$this->controllerName.'/index', $data);
	}
}
