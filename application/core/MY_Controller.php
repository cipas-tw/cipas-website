<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	protected $controllerName;

	public function __construct(){
		parent::__construct();
		$this->controllerName = strtolower(get_class($this));

		if(!empty($_SERVER['REQUEST_URI'])){
			$this->urlParserStr($_SERVER['REQUEST_URI']);
		}

		foreach($_GET as $key => $val){
			$this->parserStr($key);
		}

		foreach($_POST as $key => $val){
			$this->parserStr($key);
		}

		if( isset($_GET['page']) ){
			if (!is_numeric($_GET['page'])){
					header('Location: http://www.cipas.gov.tw/');exit;
			}
		}



	}

	protected function showView($view, $data=[]){
		$denyHeaderList = array('/error/404');
		$denyFooterList = array('/error/404');

		$loadHeader = !in_array($view, $denyHeaderList);
		$loadFooter = !in_array($view, $denyFooterList);

		$this->load->model('Articles_model');
		$this->load->model('Keywords_model');
		$this->load->model('Links_model');

		$historyLinkData = $this->Links_model->getData(1);

		$data['header']['hotKeyword'] = $this->Keywords_model->getList(false, [4,0]);
		$data['header']['historyLink'] = $historyLinkData['hist_link_url'];
		$data['footer']['historyLink'] = $historyLinkData['hist_link_url'];

		$data['header']['newsMenu'] = $data['footer']['newsMenu'] = $this->Articles_model->getNewsTypeList();

		// 載入 head
		$data['head'] = isset($data['head']) ? $data['head'] : [];
		$data['headHtml'] = $this->load->view('/common/head', $data['head'], true);

		// 載入 breadcrumb
		$data['breadcrumb'] = isset($data['breadcrumb']) ? $data['breadcrumb'] : [];
		$data['breadcrumbHtml'] = $this->load->view('/common/breadcrumb', $data['breadcrumb'], true);

		$data['scriptsHtml'] = $this->load->view('/common/scripts', [], true);

		// 載入 header
		if( $loadHeader ){
			$data['header'] = isset($data['header']) ? $data['header'] : [];
			$data['headerHtml'] = $this->load->view('/common/header', $data['header'], true);
		}

		// 載入 footer
		if( $loadFooter ){
			$data['footer'] = isset($data['footer']) ? $data['footer'] : [];
			$data['footerHtml'] = $this->load->view('/common/footer', $data['footer'], true);
		}

		// 載入 body
		$this->load->view($view, $data);
	}

	// 取得分頁設定
	protected function getPageConfig(){
		$pageConfig['full_tag_open'] = '<div class="pagination-wrap text-center"><ul class="pagination">';
		$pageConfig['full_tag_close'] = '</ul></div>';
		$pageConfig['per_page'] = 6;
		$pageConfig['num_links'] = 5;
		$pageConfig['query_string_segment'] = 'page';
		$pageConfig['prev_link'] = '&laquo;';
		$pageConfig['prev_tag_open'] = '<li>';
		$pageConfig['prev_tag_close'] = '</li>';
		$pageConfig['next_link'] = '&raquo;';
		$pageConfig['next_tag_open'] = '<li>';
		$pageConfig['next_tag_close'] = '</li>';
		$pageConfig['cur_tag_open'] = '<li class="active"><a>';
		$pageConfig['cur_tag_close'] = '</a></li>';
		$pageConfig['num_tag_open'] = '<li>';
		$pageConfig['num_tag_close'] = '</li>';
		$pageConfig['page_query_string'] = true;
		$pageConfig['use_page_numbers'] = true;
		$pageConfig['first_link'] = false;
		$pageConfig['last_link'] = false;

		return $pageConfig;
	}

	//將陣列的key和value組合成Http Get的格式
	protected function combineGetParams($queryParams){
		$httpGetParams = '';
		foreach($queryParams as $key => $value){

			if(!is_array($value) && (trim($value) || $value === 0)){

				$httpGetParams .= '&' . $key . '=' .$value;
			}elseif(is_array($value)){
				foreach($value as $single_value){
					$httpGetParams .= '&' . $key . '[]=' .$single_value;
				}
			}
		}
		return $httpGetParams;
	}

	//取得目前頁數的位移
	protected function getCurrentPageOffset($num, $maxNum){
		$offset = $this->input->get('page', true) ? $this->input->get('page', true) : 1;
		$offset = ($offset - 1) * $num;

		//判斷到這頁的總數是否大於total_rows數 如果大於代表超過頁數，引導至最後一頁
		if( $maxNum != 0 ){
			if($offset >= $maxNum){
				$page = 0;
				if( $maxNum % $num == 0){
					$page = $maxNum / $num;
				}else{
					$page = (int)( $maxNum / $num ) + 1;
				}
				//redirect($this->pagination->base_url.'&page='.$page);
			}
		}
		return $offset;
	}

	protected function postFieldChekck($saveField, $haveField, $dataList = array()){
		$dataList = !empty($dataList)? $dataList : $this->input->post();

		$returnData = $dangerField = $dangerDataType = [];
		foreach($saveField as $field=>$fieldInfo){

			// 檢查必填欄位是否有填寫
			if(in_array($field, $haveField) && isset($dataList[$field]) && ($fieldInfo['dataType'] != 'array' && trim($dataList[$field]) =='')){

				$dangerField[] = $fieldInfo['name'];
			} else {
				if(isset($dataList[$field])){
					// 檢查欄位型態
					if(!$this->dataTypeCheck($fieldInfo['dataType'], $dataList[$field])){
						$dangerDataType[] = $fieldInfo['name'];
					}

					// html encode
					if($fieldInfo['dataType'] == 'string'){
						$dataList[$field] = addslashes($dataList[$field]); //stripslashes
					}
				}
			}
			if(isset($dataList[$field])){
				if($fieldInfo['dataType'] == 'array'){
					$returnData[$field] = $this->input->post($field, true);
				} else{
					$returnData[$field] = trim($dataList[$field]);
				}
			}
		}

		$dangerMessage = '';
		if($dangerField){
			$dangerMessage = implode($dangerField, '、').' 欄位未填寫，';
		}

		if($dangerDataType){
			$dangerMessage .= implode($dangerDataType, '、').' 資料型態錯誤，';
		}

		if($dangerMessage !=''){

			$alerts[$this->config->item('alertDanger')] = $dangerMessage.'請重新填寫!';
			$this->showAlerts($alerts);
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			return $returnData;
		}
	}

	protected function dataTypeCheck($dataType, $value){
		switch ($dataType) {
			case 'bool':
				return is_bool($value);
				break;

			case 'integer':
				return is_numeric($value);
				break;

			case 'float':
				return is_float($value);
				break;

			case 'double':
				return is_double($value);
				break;

			case 'string':
				return (is_string($value)? is_string($value) : is_numeric($value));
				break;

			case 'array':
				return is_array($value);
				break;

			case 'object':
				return is_object($value);
				break;

			case 'resource':
				return is_resource($value);
				break;
		}
	}

	protected function moveFile($fromFile , $toFile){

		//檢查目錄是否存在
		$urls = explode('/', $toFile);
		$path = '';
		foreach($urls as $va){
			if(!strpos($va, '.')){
				$path .= $va.'/';
				if( !is_dir($path) ){
					mkdir($path, 0777);
				}
			}
		}

		rename('./'.$fromFile ,'./'.$toFile);

		return true;
	}

	protected function inputGet($name, $xss_clean = false){
		$retrunData = $this->input->get($name, $xss_clean);
		return trim($retrunData);
	}

	protected function inputPost($name, $xss_clean = false){
		$retrunData = $this->input->post($name, $xss_clean);
		return trim($retrunData);
	}

	protected function get_chinese_weekday($datetime)
	{
	    $weekday = date('w', $datetime);
	    return ['日', '一', '二', '三', '四', '五', '六'][$weekday];
	}

	protected function parserStr($var)
	{

		// 排除掉白名單IP edit by Leo 20140703

		//mysql_query("SET NAMES 'UTF8'");

		$strPost = "";
		if (isset($_GET[$var]))
			{
			if (is_array($_GET[$var]))
				{
				$strPost = $_GET[$var];
				}
			  else
				{
				$strPost = addslashes($_GET[$var]);
				}
			}
		elseif (isset($_POST[$var]))
			{
			if (is_array($_POST[$var]))
				{
				$strPost = $_POST[$var];
				}
			  else
				{
				$strPost = addslashes($_POST[$var]);
				}
			}

		// sql injection Check Start

		$kw = array(
			'update',
			'select',
			'script',
			'insert',
			'iframe',
			'drop',
			'delete',
			' alert',
			'<script',
			' or ',
			'onmouse',
			'('
		);
		$b_valid = true;
		if (is_array($strPost))
			{
			foreach($strPost as $key => $va)
				{
				$loStrPost = strtolower($va);
				foreach($kw as $va)
					{
					if (stripos($loStrPost, $va) !== false)
						{
						$b_valid = false;
						}
					}
				}
			}
		  else
			{
			$loStrPost = strtolower($strPost);
			foreach($kw as $va)
				{
				if (stripos($loStrPost, $va) !== false)
					{
					$b_valid = false;
					}
				}
			}

		if ($b_valid == false)
			{
			header('Location: http://www.cipas.gov.tw/');exit;
			}
		  else
			{
			return $strPost;
			}
	}

	protected function urlParserStr($strUrl)
	{

		// 排除掉 XSS script 攻擊
		// sql injection Check Start

		$kw = array(
			'script>',
			'onmouse',
			'<img',
			'<iframe',
			'<xss',
			'onclick=',
			'<a',
			'onload=',
			'<script',
			'<applet',
			'<body',
			'<embed',
			'<frame',
			'<frameset',
			'<html',
			'<img',
			'<style',
			'<layer',
			'<link',
			'<ilayer',
			'<meta',
			'<object',
			'update',
			'select',
			'script',
			'insert',
			'iframe',
			'drop',
			'delete',
			' alert',
			'<script',
			' or ',
			'onmouse',
			'alert',
			'location',
			'(',
			'=\''
		);
		$b_valid = true;
		$loStrUrl = urldecode(urldecode(strtolower($strUrl)));
		foreach($kw as $va)
			{
			if (stripos($loStrUrl, $va) !== false)
				{
				$b_valid = false;
				}
			}

		if ($b_valid == false)
			{
			header('Location: http://www.cipas.gov.tw/');exit;
			}
		  else
			{
			return true;
			}
	}
}
