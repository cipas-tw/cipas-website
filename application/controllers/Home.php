<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->unit = '';

		$this->defultImgCipas = $this->config->item('defultImgCipas');
		$this->newsCropSize = $this->config->item('defultCropSize');
		$this->sliderCropSize = $this->config->item('sliderCropSize');
		$this->uploadPath = $this->config->item('uploadPath');
		$this->sliderBannerPath = $this->uploadPath.$this->config->item('sliderBannerPath').$this->sliderCropSize[0]['path'];
		$this->newsPath = $this->uploadPath.$this->config->item('newsPath').$this->newsCropSize[1]['path'];

	}

	public function index(){

		$data = [];
		$data['unit'] = $this->unit;
		$this->load->model('Banners_model');
		$this->load->model('Articles_model');

		$data['sliderBanner'] = $this->Banners_model->getList(false, [4,0]);
		$data['newsList'] = $this->Articles_model->getList(false, [6,0]);
		$data['sliderBannerPath'] = $this->sliderBannerPath;
		$data['newsPath'] = $this->newsPath;
		$data['defultImgCipas'] = $this->defultImgCipas;
		$data['httpGetParams'] = isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER'] : '';
		$this->showView('index', $data);
	}

	public function opendata(){

		$data = [];
		$data['unit'] = $this->unit;

		$data['title'] = '政府網站資料開放宣告';
		$data['breadcrumb']['nowPage'] = $data['head']['title'] = $data['title'];

		$data['httpGetParams'] = isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER'] : '';
		$this->showView('/'.$this->controllerName.'/opendata', $data);
	}

	public function search(){
		$data = [];
		$this->showView('/home/search', $data);
	}

	public function view500(){
		$data = [];
		$data['head']['includeCss'] = 'error';
		$data['unit'] = '500';
		$this->showView('view500', $data);
	}

	public function view404(){
		$data = [];
		$data['head']['includeCss'] = 'error';
		$data['unit'] = '404';
		$this->showView('view404', $data);
	}

	public function api(){
        $this->showView('api');
    }


}
