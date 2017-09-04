<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends MY_ApiController {

	public function __construct(){
		parent::__construct();
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
		header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Accept');
	}

	public function about_members()
	{

		$this->result['status_code'] = '0000';
		$this->load->model('Members_model');
		$data = $this->Members_model->getList(false, 'all');

        foreach($data as $k=>$value){
        	$data[$k]['commissioner_education'] = json_decode($value['commissioner_education'], true);
        	$data[$k]['commissioner_experience'] = json_decode($value['commissioner_experience'], true);
        }

		$this->result['data'] = $data;
		$this->printResult();

		
	}


	public function news()
	{

		$detail_id = $this->input->get('detail_id');	//抓參數
		$this->result['status_code'] = '0000';
		$this->load->model('Articles_model');

		if (isset($detail_id)) {
			$data['0'] = $this->Articles_model->getData($detail_id);	// 單筆資料
		}else{
			$data = $this->Articles_model->getList(false, 'all');		// 多筆資料
		}

		if (isset($data['0'])) {
			foreach ($data as $key => $value) {
				unset($data[$key]['news_type_id']);
				$data[$key]['newsFile'] = $this->Articles_model->getFileList(array('news_id'=>$data[$key]['news_id']));
			}
		}
		
		$this->result['data'] = $data;
		$this->printResult();

		
	}

	public function investigations()
	{

		$detail_id = $this->input->get('detail_id');	//抓參數
		$this->result['status_code'] = '0000';
		$this->load->model('Investigations_model');

		if (isset($detail_id)) {
			$data['0'] = $this->Investigations_model->getData($detail_id);			// 單筆資料
		}else{
			$data = $this->Investigations_model->getList(false, 'all');				// 多筆資料
		}

		if (isset($data['0'])) {
			foreach ($data as $key => $value) {
				$data[$key]['surveyNote'] = $this->Investigations_model->getNoteList(array('survey_id'=>$data[$key]['survey_id']));
			}
		}

		$this->result['data'] = $data;
		$this->printResult();

		
	}

	public function hearings(){

		$detail_id = $this->input->get('detail_id');	//抓參數
		$this->result['status_code'] = '0000';
		$this->load->model('Hearings_model');

		if (isset($detail_id)) {
			$data['0'] = $this->Hearings_model->getData($detail_id);			// 單筆資料
		}else{
			$data = $this->Hearings_model->getList(false, 'all');				// 多筆資料
		}

		if (isset($data['0'])) {
			foreach ($data as $key => $value) {
				$data[$key]['hearingNote'] = $this->Hearings_model->getNoteList(array('hearing_id'=>$data[$key]['hearing_id']));
			}
		}

		$this->result['data'] = $data;
		$this->printResult();

		
	}

	public function administrative_actions(){

		$detail_id = $this->input->get('detail_id');	//抓參數
		$this->result['status_code'] = '0000';
		$this->load->model('AdministrativeActions_model');

		if (isset($detail_id)) {
			$data['0'] = $this->AdministrativeActions_model->getData($detail_id);			// 單筆資料
		}else{
			$data = $this->AdministrativeActions_model->getList(false, 'all');				// 多筆資料
		}

		if (isset($data['0'])) {
			foreach ($data as $key => $value) {
				$data[$key]['administrativeactNote'] = $this->AdministrativeActions_model->getNoteList(array('adm_act_id'=>$data[$key]['adm_act_id']));
			}
		}

		$this->result['data'] = $data;
		$this->printResult();

		
	}

	public function litigations(){
		
		$detail_id = $this->input->get('detail_id');	//抓參數
		$this->result['status_code'] = '0000';
		$this->load->model('Litigations_model');

		if (isset($detail_id)) {
			$data['0'] = $this->Litigations_model->getData($detail_id);			// 單筆資料
		}else{
			$data = $this->Litigations_model->getList(false, 'all');				// 多筆資料
		}

		if (isset($data['0'])) {
			foreach ($data as $key => $value) {
				$data[$key]['litigationNote'] = $this->Litigations_model->getNoteList(array('litigation_id'=>$data[$key]['litigation_id']));
				$data[$key]['litigationFile'] = $this->Litigations_model->getFileList(array('litigation_id'=>$data[$key]['litigation_id']));
			}
		}

		$this->result['data'] = $data;
		$this->printResult();

		
	}

	public function organic_rules(){

		$detail_id = $this->input->get('detail_id');	//抓參數
		$this->result['status_code'] = '0000';
		$this->load->model('OrganicRules_model');

		if (isset($detail_id)) {
			$data['0'] = $this->OrganicRules_model->getData($detail_id);			// 單筆資料
		}else{
			$data = $this->OrganicRules_model->getList(false, 'all');				// 多筆資料
		}

		if (isset($data['0'])) {
			foreach ($data as $key => $value) {
				$data[$key]['orgRulesFile'] = $this->OrganicRules_model->getFileList(array('org_rules_id'=>$data[$key]['org_rules_id']));
			}
		}

		$this->result['data'] = $data;
		$this->printResult();
	}

	public function regulations(){

		$detail_id = $this->input->get('detail_id');	//抓參數
		$this->result['status_code'] = '0000';
		$this->load->model('Regulations_model');

		if (isset($detail_id)) {
			$data['0'] = $this->Regulations_model->getData($detail_id);			// 單筆資料
		}else{
			$data = $this->Regulations_model->getList(false, 'all');				// 多筆資料
		}

		if (isset($data['0'])) {
			foreach($data as $k=>$value){
				$termsList = $this->Regulations_model->getTermsList($data[$k]['law_id']);
				foreach($termsList as $val){
					if(!isset($data['termsList'][$val['law_chapter_id']])){
						$data['termsList'][$val['law_chapter_id']]['chapter_title'] = $val['law_chapter_title'];
						$data['termsList'][$val['law_chapter_id']]['list'] = [];
					}
					$data['termsList'][$val['law_chapter_id']]['list'][] = $val['law_terms_content'];
				}
				$data['lawFile'] = $this->Regulations_model->getFileList(array('law_id'=>$data[$k]['law_id']));
	        }
	    }

		$this->result['data'] = $data;
		$this->printResult();
	}

	public function interpretations(){

		$detail_id = $this->input->get('detail_id');	//抓參數
		$this->result['status_code'] = '0000';
		$this->load->model('Interpretations_model');

		if (isset($detail_id)) {
			$data['0'] = $this->Interpretations_model->getData($detail_id);			// 單筆資料
		}else{
			$data = $this->Interpretations_model->getList(false, 'all');				// 多筆資料
		}

		$this->result['data'] = $data;
		$this->printResult();
	}

	public function policies(){

		$this->result['status_code'] = '0000';

		$this->load->model('Policies_model');

		$data = $this->Policies_model->getList(false, 'all');

		$this->result['data'] = $data;

		$this->printResult();

		
	}

	public function links(){

		$this->result['status_code'] = '0000';

		$this->load->model('Links_model');

		$data = $this->Links_model->getData(1);

		$this->result['data'] = $data['hist_link_url'];

		$this->printResult();

		
	}

	public function budgets(){

		$this->result['status_code'] = '0000';

		$this->load->model('Budgets_model');

		$data = $this->Budgets_model->getList(false, 'all');

		$this->result['data'] = $data;

		$this->printResult();

		
	}

	public function statistics(){

		$this->result['status_code'] = '0000';

		$this->load->model('Statistics_model');

		$data = $this->Statistics_model->getList(false, 'all');

		$this->result['data'] = $data;

		$this->printResult();

		
	}


	public function journals(){

		$detail_id = $this->input->get('detail_id');	//抓參數
		$this->result['status_code'] = '0000';
		$this->load->model('Journals_model');

		if (isset($detail_id)) {
			$data['0'] = $this->Journals_model->getData($detail_id);			// 單筆資料
		}else{
			$data = $this->Journals_model->getList(false, 'all');				// 多筆資料
		}

		if (isset($data['0'])) {
			foreach ($data as $key => $value) {
				unset($data[$key]['journal_type_id']);
				$data[$key]['journalFile'] = $this->Journals_model->getFileList(array('journal_id'=>$data[$key]['journal_id']));
			}
		}

		$this->result['data'] = $data;

		$this->printResult();
		
	}

	public function purchases(){

		$this->result['status_code'] = '0000';

		$this->load->model('Purchases_model');

		$data = $this->Purchases_model->getList(false, 'all');

		$this->result['data'] = $data;

		$this->printResult();

		
	}


	public function videos(){

		$detail_id = $this->input->get('detail_id');	//抓參數
		$this->result['status_code'] = '0000';
		$this->load->model('Videos_model');

		if (isset($detail_id)) {
			$data['0'] = $this->Videos_model->getData($detail_id);			// 單筆資料
		}else{
			$data = $this->Videos_model->getList(false, 'all');				// 多筆資料
		}

		if (isset($data['0'])) {
			foreach ($data as $key => $value) {
				$data[$key]['videoFile'] = $this->Videos_model->getFileList(array('video_id'=>$data[$key]['video_id']));
			}
		}

		$this->result['data'] = $data;
		$this->printResult();
	}

	public function collect(){

		$this->result['status_code'] = '0000';

		$this->load->model('Collect_model');

		$id = 1;

		$data = $this->Collect_model->getData($id);

		$data['collectPlanFile'] = $this->Collect_model->getFileList(array('collect_plan_id'=>$id));

		$this->result['data'] = $data;

		$this->printResult();

		
	}

	public function stories(){

		$detail_id = $this->input->get('detail_id');	//抓參數
		$this->result['status_code'] = '0000';
		$this->load->model('Stories_model');

		if (isset($detail_id)) {
			$data['0'] = $this->Stories_model->getData($detail_id);			// 單筆資料
		}else{
			$data = $this->Stories_model->getList(false, 'all');				// 多筆資料
		}

		if (isset($data['0'])) {
			foreach ($data as $key => $value) {
				$data[$key]['historyStoryFile'] = $this->Stories_model->getFileList(array('history_story_id'=>$data[$key]['history_story_id']));
			}
		}

		$this->result['data'] = $data;
		$this->printResult();
	}

	public function faq(){

		$this->result['status_code'] = '0000';

		$this->load->model('Questions_model');

		$data = $this->Questions_model->getList(false, 'all');

		$this->result['data'] = $data;

		$this->printResult();

		
	}

	public function downloads(){

		$this->result['status_code'] = '0000';

		$this->load->model('Downloads_model');

		$data = $this->Downloads_model->getList(false, 'all');

		$this->result['data'] = $data;

		$this->printResult();

		
	}



	public function declarations(){

		$detail_id = $this->input->get('detail_id');	//抓參數
		$this->result['status_code'] = '0000';
		$this->load->model('Declarations_model');

		$id = 1;
		$data['explain'] = $this->Declarations_model->getExplainData($id);

		if (isset($detail_id)) {
			$data['declarationList']['0'] = $this->Declarations_model->getData($detail_id);					// 單筆資料
		}else{
			$data['declarationList'] = $this->Declarations_model->getList(false, 'all');					// 多筆資料
		}
		
		if (isset($data['declarationList']['0'])) {
			foreach ($data['declarationList'] as $key => $value) {
				$data['declarationList'][$key]['declarationListFile'] = $this->Declarations_model->getFileList(array('declaration_id'=>$key));
			}
		}
		
		$this->result['data'] = $data;
		$this->printResult();

		
	}

	public function rewards(){

		$detail_id = $this->input->get('detail_id');	//抓參數
		$this->result['status_code'] = '0000';
		$this->load->model('Rewards_model');

		$data['rewardListData'] = $this->Rewards_model->getRewardListData();
		$data['rewardListChapterAndTermsList'] = $this->Rewards_model->getRewardListChapterAndTermsList([], 'all');

		if (isset($detail_id)) {
			$data['rewardList']['0'] = $this->Rewards_model->getData($detail_id);					// 單筆資料
		}else{
			$data['rewardList'] = $this->Rewards_model->getList([], 'all');					// 多筆資料
		}

		$this->result['data'] = $data;
		$this->printResult();

		
	}

	public function recoveries(){

		$detail_id = $this->input->get('detail_id');	//抓參數
		$this->result['status_code'] = '0000';
		$this->load->model('Recoveries_model');

		$data['repossessListData'] = $this->Recoveries_model->getRepossessListData();
		$data['repossessListChapterAndTermsList'] = $this->Recoveries_model->getRepossessListChapterAndTermsList([], 'all');

		if (isset($detail_id)) {
			$data['repossessList']['0'] = $this->Recoveries_model->getData($detail_id);					// 單筆資料
		}else{
			$data['repossessList'] = $this->Recoveries_model->getList([], 'all');					// 多筆資料
		}

		$this->result['data'] = $data;
		$this->printResult();
	}

}
