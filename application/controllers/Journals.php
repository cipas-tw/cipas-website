<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class journals extends MY_Controller {
	public function __construct(){
		parent::__construct();

		$this->defultImg = $this->config->item('defultImgDoc');
		$this->uploadPath = $this->config->item('uploadPath');
		$this->cropSize = $this->config->item('defultCropSize');
	}

	public function index(){
		$this->load->model('Journals_model');

		$data = [];
		$data['title'] = '期刊文獻';
		$data['breadcrumb']['nowPage'] = $data['head']['title'] = $data['title'];
		
		$journalsType = $this->Journals_model->getJournalTypeList();
		$data["journalsType"] = $journalsType;
		
		$pagination = array();
		$journalsList = array();
		
		
		foreach($journalsType as $k => $val){
			$pageString = 'page'.$val["journal_type_id"];
			$offset = $this->input->get($pageString, true) ? $this->input->get($pageString, true) : 1;
			$this->session->set_userdata($pageString, $offset);
		}

		foreach($journalsType as $key => $va){
			$pageString = 'page'.$va["journal_type_id"];
			$paginationObj = new CI_Pagination();
			$journal_type_id = $va["journal_type_id"];
			$queryData = array();
			$queryData["journalType"] = $journal_type_id;
			// 分頁
			$pageConfig = $this->getPageConfig();
			
			$baseUrlString = __FUNCTION__.'?journalTypeId='.$journal_type_id;
			
			foreach($journalsType as $k => $val){
				if($key != $k){
					if($this->session->userdata('page'.$val["journal_type_id"])){
						$baseUrlString.="&".'page'.$val["journal_type_id"]."=".$this->session->userdata('page'.$val["journal_type_id"]);
					}
				}
			}
			
			$pageConfig['base_url'] = $baseUrlString;
			$pageConfig['total_rows'] = $this->Journals_model->getList($queryData, []);
			$pageConfig['query_string_segment'] = $pageString;
			$paginationObj->initialize($pageConfig);
			
			
			
			$result = $this->Journals_model->getList($queryData, array($pageConfig['per_page'], $this->getOemCurrentPageOffset($offset, $pageConfig['per_page'], $pageConfig['total_rows'])));
			
			
			// 資料整理
			/*foreach($result as $k=>$val){
				$date = strtotime($val['journal_show_date']);
				$result[$k]['journal_show_date'] = date('Y/m/d (', $date).$this->get_chinese_weekday($date).')';
			}*/
			
			$journalsList[$journal_type_id] = $result;
			$pagination[$journal_type_id] = $paginationObj;
			
		}
		
		
		$data["journalsList"] = $journalsList;
		$data["pagination"] = $pagination;
		
		
		
		


		
		
		//$data['imgPath'] = $this->uploadPath.$this->config->item('journalPath').$this->cropSize[1]['path'];
		//$data['defultImg'] = $this->config->item('defultImgDoc');
		$this->showView('/'.$this->controllerName.'/index', $data);
	}
	
	
	
	//取得目前頁數的位移
	protected function getOemCurrentPageOffset($offset, $num, $maxNum){

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
	
	public function detail($id){
		$this->load->model('Journals_model');

		$data = [];

		$data['result'] = $this->Journals_model->getData($id);
		if($id =='' || !isset($data['result'])){
			redirect('/'.$this->controllerName);
		}

		$data['resultFile'] = $this->Journals_model->getFileList(array('journal_id'=>$id));

		$data['head']['title'] = $data['result']['journal_title'];
		$data['head']['title'] = $data['result']['journal_type_name'].'-'.$data['result']['journal_title'];
		$data['breadcrumb']['nowPage'] = $data['result']['journal_title'];
		$data['breadcrumb']['prevPage'] = array('url'=>'/'.$this->controllerName.'?journalType='.$data['result']['journal_type_id'], 'name'=>$data['result']['journal_type_name']);

		$data['head']['metaTitle'] = rawurlencode(mb_convert_encoding($data['result']['journal_title'], 'big5', 'utf-8'));
		$data['head']['metaDescription'] = stripslashes($data['result']['journal_meta_description']);
		$data['head']['metaUrl'] = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
		$data['head']['metaImg'] = '';

		$data['httpGetParams'] = isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER'] : '';

		$data['imgPath'] = $this->uploadPath.$this->config->item('journalPath').$this->cropSize[0]['path'];
		$data['filePath'] = $this->uploadPath.$this->config->item('journalPath');
		$this->showView('/'.$this->controllerName.'/detail', $data);
	}
}
