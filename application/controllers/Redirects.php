<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Redirects extends MY_Controller {
	public function __construct(){
		parent::__construct();
	}

	public function newsview($id=0){
		$gazettes_id = array(60=>46,21=>10,23=>13,24=>14,27=>17,29=>19,33=>22,36=>25,37=>26,38=>27,40=>29,41=>30,43=>32,44=>33,45=>34,46=>35,48=>36,49=>37,50=>38,15=>4,54=>40,55=>41,56=>42,57=>43,59=>45,16=>5,19=>8,20=>9);
		$presses_id = array(2=>1,22=>11,25=>15,26=>16,28=>18,9=>2,31=>20,32=>21,34=>23,35=>24,39=>28,12=>3,42=>31,52=>39,58=>44,17=>6,18=>7,14=>70,13=>71,8=>72,1=>73);
		if(isset($gazettes_id[$id]) || isset($presses_id[$id])){
			$url = '';
			$url = isset($gazettes_id[$id]) ? '/gazettes/'.$gazettes_id[$id] : $url ;
			$url = isset($presses_id[$id]) ? '/presses/'.$presses_id[$id] : $url ;
			redirect($url);
			exit;
		}else{
			redirect('home');
			exit;
		}
	}
	public function activityview($id=0){
		redirect('home');
		exit;
	}
	public function lawview($id=0){
		$idArray = array(14=>75,13=>76,12=>77,11=>78,10=>79,9=>80,8=>81,3=>82);
		if(isset($idArray[$id])){
			redirect('/gazettes/'.$idArray[$id]);
			exit;
		}elseif ($id == '15') {
			redirect('regulations/8');
			exit;
		}else{
			redirect('home');
			exit;
		}
		
	}
	public function meetingview($id=0){
		$idArray = array(24=>47,23=>48,22=>49,21=>50,20=>51,19=>52,18=>53,17=>54,15=>55,14=>56,13=>57,12=>58,11=>59,10=>60,9=>61,8=>62,7=>63,6=>64,5=>65,4=>66,3=>67,2=>68,1=>69);
		if(isset($idArray[$id])){
			redirect('/meetings/'.$idArray[$id]);
			exit;
		}else{
			redirect('home');
			exit;
		}
	}

}
