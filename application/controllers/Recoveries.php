<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recoveries extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->unit = '';
	}

	public function index(){
		$this->load->model('Recoveries_model');
		$data = [];
		$data['head']['title'] = '回復權利';
		$data['breadcrumb']['nowPage'] = $data['head']['title'];
		$data['resultRepossessList'] = $this->Recoveries_model->getRepossessListData();
		$data['resultRepossessListChapterAndTermsList'] = $this->Recoveries_model->getRepossessListChapterAndTermsList([], 'all');
		$data['result'] = $this->Recoveries_model->getList([], 'all');
		$data['httpGetParams'] = isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER'] : '';
		$this->showView('/'.$this->controllerName.'/index', $data);
	}

	public function detail($id){
		$this->load->model('Recoveries_model');
		$data = [];
		$data['result'] = $this->Recoveries_model->getData($id);
		if( $id =='' || !isset($data['result']) ){
			redirect('/'.$this->controllerName);
		}
		$data['resultFile'] = $this->Recoveries_model->getFileList(array('repo_id'=>$id));

		$data['head']['metaTitle'] = rawurlencode(mb_convert_encoding($data['result']['repo_title'], 'big5', 'utf-8'));
		$data['head']['metaUrl'] = $this->config->item('metaUrl');
		$data['head']['metaDescription'] = stripslashes($data['result']['repo_meta_description']);
		$data['head']['metaImg'] = '';

		$data['head']['title'] = '回復權利-'.$data['result']['repo_title'];
		$data['breadcrumb']['nowPage'] = $data['result']['repo_title'];
		$data['breadcrumb']['prevPage'] = array('url'=>'/'.$this->controllerName, 'name'=>'回復權利');
		$data['filePath'] = $this->config->item('uploadPath').$this->config->item('repossessPath');
		$data['httpGetParams'] = isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER'] : '';
		$this->showView('/'.$this->controllerName.'/detail', $data);
	}
}
