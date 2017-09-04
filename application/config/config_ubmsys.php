<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//後台
define('HEAD_TITLE', '不當黨產處理委員會');
define('FOOTER_COMPANY', '不當黨產處理委員會');
define('FOOTER_COMPANY_URL', 'http://www.cipas.gov.tw/');
define('FOOTER_YEAR', '2017');

$config['alertSuccess'] = 'success';
$config['alertWarning'] = 'warning';
$config['alertInfo'] = 'info';
$config['alertDanger'] = 'danger';

$config['status'] = array(0=>'不啟用', 1=>'啟用');
$config['sliderBannerType'] = array(1=>'圖片', 2=>'直播語音', 3=>'Youtube');
$config['sidebarPermissionType'] = array('A'=>'檢視', 'B'=>'新增', 'C'=>'修改', 'D'=>'刪除');


$config['alertAddSuccess'] = '新增成功！';
$config['alertUpdateSuccess'] = '更新成功！';
$config['alertDeleteSuccess'] = '刪除成功！';
$config['alertDBError'] = '資料寫入失敗，請重新輸入';


// 檔案路徑
$config['uploadPath'] = 'public/upload/';
$config['tmpPath'] = 'tmp/';
$config['deletePath'] = 'delete/';

$config['purchasePath'] = 'purchase/';
$config['policyPath'] = 'policy/';
$config['budgetPath'] = 'budget/';
$config['salesPath'] = 'sales/';
$config['filesPath'] = 'files/';
$config['newsPath'] = 'news/';
$config['rulePath'] = 'rule/';
$config['orgRulesPath'] = 'orgRules/';
$config['historyStoryPath'] = 'historyStory/';
$config['declarationPath'] = 'declaration/';
$config['journalPath'] = 'journal/';
$config['videoPath'] = 'video/';
$config['collectPlanPath'] = 'collectPlan/';
$config['administrativeActPath'] = 'administrativeAct/';
$config['hearingPath'] = 'hearing/';
$config['commissionerPath'] = 'commissioner/';
$config['sliderBannerPath'] = 'sliderBanner/';
$config['repossessPath'] = 'repossess/';
$config['rewardPath'] = 'reward/';
$config['photoPath'] = 'photo/';
$config['aboutPath'] = 'about/';

// 縮圖尺寸
$config['defultCropSize'] = array(
	0 => array('path'=> '', 'width'=> 1024, 'height'=> 1024)
);
$config['sliderCropSize'] = array(
	0 => array('path'=> '', 'width'=> 720, 'height'=> 405)
);

$config['status_msg'] = array(
	'0000' => '成功',
	
);