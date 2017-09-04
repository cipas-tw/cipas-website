<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rewards extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->unit = '';
	}

	public function index(){
		$this->load->model('Rewards_model');
		$data = [];
		$data['head']['title'] = '獎勵舉發';
		$data['breadcrumb']['nowPage'] = $data['head']['title'];
		$data['resultRewardList'] = $this->Rewards_model->getRewardListData();
		$data['resultRewardListChapterAndTermsList'] = $this->Rewards_model->getRewardListChapterAndTermsList([], 'all');
		$data['result'] = $this->Rewards_model->getList([], 'all');
		$data['httpGetParams'] = isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER'] : '';
		$this->showView('/'.$this->controllerName.'/index', $data);
	}

	public function detail($id){
		$this->load->model('Rewards_model');
		$data = [];
		$data['result'] = $this->Rewards_model->getData($id);
		if( $id =='' || !isset($data['result']) ){
			redirect('/'.$this->controllerName);
		}
		$data['resultFile'] = $this->Rewards_model->getFileList(array('reward_id'=>$id));

		$data['head']['metaTitle'] = rawurlencode(mb_convert_encoding($data['result']['reward_title'], 'big5', 'utf-8'));
		$data['head']['metaDescription'] = stripslashes($data['result']['reward_meta_description']);
		$data['head']['metaUrl'] = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
		$data['head']['metaImg'] = '';

		$data['head']['title'] = '獎勵舉發-'.$data['result']['reward_title'];
		$data['breadcrumb']['nowPage'] = $data['result']['reward_title'];
		$data['breadcrumb']['prevPage'] = array('url'=>'/'.$this->controllerName, 'name'=>'獎勵舉發');
		$data['httpGetParams'] = isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER'] : '';

		$data['filePath'] = $this->config->item('uploadPath').$this->config->item('rewardPath');

		$this->showView('/'.$this->controllerName.'/detail', $data);
	}
}
