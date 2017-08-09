<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'libraries/MY_REST_Controller.php');

class Users extends MY_REST_Controller {

	public function __construct()
{
	parent::__construct();

}
	public function list_get(){
		$users = [];
		$page = $this->get('page');
		$nbUsers = $this->ion_auth->users()->num_rows();
		
		if($page === NULL) {
			$page = 0;
		}
		$this->ion_auth->limit(5);
		$this->ion_auth->offset(($page-1)*5);
		$usersIonAuth = $this->ion_auth->users()->result();

		foreach ($usersIonAuth as $user){
			$userIonAuth = (array)($user);
			$users[] =array( 'id' => $userIonAuth['id'], 'username' => $userIonAuth['username'], 'first_name' => $userIonAuth['first_name'], 'last_name' => $userIonAuth['last_name'], 'email' => $userIonAuth['email']);
		}

		$usersList = array(
			'options' => array('nbUsers' => $nbUsers),
			'data' => $users
		);
		$this->set_response($usersList, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
	}

}
