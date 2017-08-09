<?php

defined('BASEPATH') OR exit('No direct script access allowed');
//require(APPPATH.'libraries/MY_REST_Controller.php');
require(APPPATH.'libraries/JWT/JWT.php');




class Welcome extends CI_Controller {
private $jwtTokenEncode;
	public function __construct()
{
	parent::__construct();

	if(isset($_COOKIE['jwtToken'])) {
		$this->jwtTokenEncode = $_COOKIE['jwtToken'];
	};

}

public function loadApp() {
	setcookie('jwtToken',$this->jwtTokenEncode,time()+20,'/','',FALSE,TRUE);
	//$key = "ssssss";
	//$jwtTokenDecode =(array) Firebase\JWT\JWT::decode($this->jwtTokenEncode, $key, array('HS256'));
	//print_r($jwtTokenDecode);
	$this->load->view('userApp/userApp');

}


public function index()
{
	//$adres_IP = $_SERVER['REMOTE_ADDR'];
				//		if ($adres_IP == '10.7.12.201') {
			$this->load->view('authApp/authApp');

		//	}
}







}
?>
