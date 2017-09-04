<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notespublish extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->unit = '';

		$this->load->model('NotesPublish_model', 'models');

		$this->uploadPath = $this->config->item('uploadPath');
		$this->path = $this->uploadPath.$this->config->item('notespublishPath');
	}

	public function index(){

		redirect('/home/index');
	}

	public function detail($id){
		$data = [];
		$data['result'] = $this->models->getData($id);
		if($id =='' || !isset($data['result'])){
			redirect('/home/index');
		}
		$data['resultFile'] = $this->models->getFileList(array('notes_publish_id'=>$id));

		$data['head']['title'] = $data['result']['notes_publish_title'];
		$data['breadcrumb']['nowPage'] = $data['result']['notes_publish_title'];
		$data['head']['metaTitle'] = rawurlencode(mb_convert_encoding($data['result']['notes_publish_title'], 'big5', 'utf-8'));
		$data['head']['metaUrl'] = $this->config->item('metaUrl');
		$data['head']['metaDescription'] = '';
		$data['head']['metaImg'] = '';
		$data['httpGetParams'] = isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER'] : '';

		$data['filePath'] = $this->path;
		$this->showView('/'.$this->controllerName.'/detail', $data);
	}
}
