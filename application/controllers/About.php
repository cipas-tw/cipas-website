<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->unit = '';

		$this->commissionerCropSize = $this->config->item('commissionerCropSize');
		$this->uploadPath = $this->config->item('uploadPath');
		$this->commissionerPath = $this->uploadPath.$this->config->item('commissionerPath').$this->commissionerCropSize[0]['path'];
	}

	public function index(){
		$this->load->model('About_model');
		$id = 1;
		$data = [];
		$data['result'] = $this->About_model->getData($id);
		if($id =='' || !isset($data['result'])){
			redirect('/home/index');
		}
		$data['resultFile'] = $this->About_model->getFileList(array('about_id'=>$id));
		$data['head']['title'] = '執掌與組織';
		$data['breadcrumb']['nowPage'] = $data['head']['title'];
		$data['filePath'] = $this->config->item('uploadPath').$this->config->item('aboutPath');
		$data['httpGetParams'] = isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER'] : '';
		$this->showView('/'.$this->controllerName.'/index', $data);
	}

	public function members(){
		$this->load->model('Members_model');
		$queryData = [];
		$data = [];
		$data['head']['title'] = '本會委員';
		$data['breadcrumb']['nowPage'] = $data['head']['title'];
		$queryData['commissioner_is_leader'] = 0;
		$data['result'] = $this->Members_model->getList($queryData, 'all');
		$data['resultLeader'] = $this->Members_model->getLeaderData();
		$data['commissionerPath'] = $this->commissionerPath;
		$data['httpGetParams'] = isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER'] : '';
		$this->showView('/'.$this->controllerName.'/members', $data);
	}

}
