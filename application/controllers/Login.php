<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'libraries/MY_REST_Controller.php');
//require(APPPATH.'libraries/JWT/JWT.php');

class Login extends REST_Controller {
	private $username;
	private $password;
	private $userID;
		public function __construct()
	{
		parent::__construct();

	}

	public function login_post() {

		$this->username = $this->post('username');
		$this->password = $this->post('password');

		if($this->ion_auth->login($this->username, $this->password)) {
			$userIonAuth =(array) $this->ion_auth->user()->row();
			$this->userID = $userIonAuth['id'];
  		$this->ion_auth->logout();
			$this->prepareJwtToken();
			$this->set_response(array('message' => 'login success'), REST_Controller::HTTP_OK);
		} else {
			$this->ion_auth->logout();
			$this->set_response(array('message' => 'login failure'), REST_Controller::HTTP_UNAUTHORIZED);
			};

	}


	private function prepareJwtToken(){

		$key = "ssssss";
		$jwtToken = array(
				"iss" => "http://football.org",
				"aud" => "http://football.org",
				"iat" => time(),
				'exp' => time()+20,
				'payload' => array(	'username' => $this->username,
														'userID' => $this->userID,
														"roles"=> $this->getRolesNames() )
		);
		
		$jwtTokenEncode = Firebase\JWT\JWT::encode($jwtToken, $key);
		unset($_COOKIE['jwtToken']);
		setcookie('jwtToken',$jwtTokenEncode,time()+20,'/','',FALSE,TRUE);

	}




	private function getRolesNames() {
		$ionAuthRoles = (array)$this->ion_auth->get_users_groups($this->userID)->result();
		foreach($ionAuthRoles as $role) {
			$rolesNames[] = $role->name;
		}
		return $rolesNames;
	}


	}
	?>
