<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Extends CI_Controller
 * by DotNet - dotnetchen@unidyna.com - 2014
 */

class MY_ApiController extends CI_Controller {

	protected $controllerName;
	protected $result = array('status_code' => '2001');
	protected $logId = '';

	public function __construct(){
		parent::__construct();

		header ("content-type: application/json; charset=UTF-8");

		$this->controllerName = strtolower(get_class($this));

 		$this->writeCallLog($_POST, $_FILES, $this->uri->segment(2));


	}


	/**
     * 印出API資訊
	 * @param   string	type	1:json用 0:zip用
     */
	protected function printResult(){

		//$this->load->model('api_log_model');

		$arStatusMsg = $this->config->item('status_msg', 'config_api');

		if(isset($this->result['status_msg'])){
			$this->result['status_msg'] = $arStatusMsg[$this->result['status_code']] . ': '. $this->result['status_msg'];
		}else{
			$this->result['status_msg'] = $arStatusMsg[$this->result['status_code']];
		}

		//統一規格，沒有data會塞data陣列進去 by Awu 20151213
		if(!isset($this->result['data'])){
			$this->result['data'] = array();
		}

		$this->writeApiLog($_POST, $_FILES, $this->result, $this->uri->segment(2));

	
			//開啟 API Debug Mode, 顯示錯誤訊息
			if($this->input->get('debug_mode') === 'true'){
				echo json_encode($this->result);
			}elseif($this->input->get('debug_mode') === 'test'){
				header ("content-type: text/html");
				echo '<pre>' . print_r($this->result, true) . '</pre>';
			}else{
				echo json_encode($this->result);
			}
		
	}

	//先將呼叫的資料存入db
	protected function writeCallLog($api_post, $api_files, $apiName){

		
	}


	//將log 存入db
	protected function writeApiLog($api_post, $api_files, $api_result, $apiName){

	}
	

	//回傳二維陣列指定的column陣列
	protected function getColumnOfArray($arr=array(), $keyName=''){
		$arrayColumn = array();
		if( !empty($arr) && $keyName !== '' ){
			foreach($arr as $val){
				$arrayColumn[] = $val[$keyName];
			}
		}
		return $arrayColumn;
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

	protected function  debugPrint($param){
		echo '<pre>' . print_r($param, true) . '</pre>';
	}

}