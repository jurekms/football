<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'libraries/MY_REST_Controller.php');



class User extends MY_REST_Controller {
	private $jwtToken;

	private $id;
	private $username;
	private $password;
	private $userEmail;
	private $firstName;
	private $lastName;
	private $roles;
	private $validateErrors;
	private $validateMessages;


	public function __construct()
	{
		parent::__construct();

  }


	public function adminEdit_get()
	{

		$this->roles = [];
		$this->id = $this->get('id') == 0 ? $this->getLoggedUserID() : $this->get('id');
		$groupsIonAuth = (array)$this->ion_auth->get_users_groups($this->id)->result();
		foreach ($groupsIonAuth as $group){
			$groupIonAuth = (array)$group;
			$this->roles[] = $groupIonAuth['id'];
		};
		$userIonAuth =(array) $this->ion_auth->user($this->id)->row();
		$user =array( 'id' => $userIonAuth['id'], 'username' => $userIonAuth['username'], 'first_name' => $userIonAuth['first_name'], 'last_name' => $userIonAuth['last_name'], 'email' => $userIonAuth['email'], 'roles' => $this->roles);
		$this->set_response($user, REST_Controller::HTTP_OK);
	}



	public function adminEdit_put()
	{
		$this->id = $this->put('id');
		$this->username = $this->put('username');
		$this->password = $this->put('new_password');
		$this->userEmail = $this->put('email');
		$this->firstName = $this->put('first_name');
		$this->lastName = $this->put('last_name');
	  $this->roles = $this->put('roles');

		if($this->validateUser()) {
			$user = array(
						 'first_name' => $this->firstName,
						 'last_name' => $this->lastName,
						 'password' => $this->password,
						 'email' => $this->userEmail
							);
			 $this->ion_auth->remove_from_group(NULL, $this->id);
			 //$this->ion_auth->add_to_group($this->roles, $this->id);
			 $this->ion_auth->update($this->id, $user);
			 $this->validateMessages = $this->ion_auth->messages_array();
			 $this->set_response(array('validate' => $this->validateMessages), REST_Controller::HTTP_OK);
	 } else {
		  $this->validateErrors = $this->ion_auth->errors_array();
		 	$this->set_response(array('validate' => $this->validateErrosrs), REST_Controller::HTTP_OK);
	 }

	}



	public function add_post()
	{

		$username = $this->post('username');
		$password = $this->post('new_password');
		$email = $this->post('email');
		$additional_data = array(
						'first_name' => $this->post('first_name'),
						'last_name' => $this->post('last_name')
						);
	 $group = $this->post('group');;

	 $id = $this->ion_auth->register($username, $password, $email, $additional_data, $group);

	 $this->set_response(array('id' => $id), REST_Controller::HTTP_OK);

	}


	public function edit_get()
	{
		$groups = [];
		$id =  $this->getLoggedUserID();
		$groupsIonAuth = (array)$this->ion_auth->get_users_groups($id)->result();
		foreach ($groupsIonAuth as $group){
			$groupIonAuth = (array)$group;
			$groups[] = $groupIonAuth['id'];
		};
		$userIonAuth =(array) $this->ion_auth->user($id)->row();
		$user =array( 'id' => 0, 'username' => $userIonAuth['username'], 'first_name' => $userIonAuth['first_name'], 'last_name' => $userIonAuth['last_name'], 'email' => $userIonAuth['email'], 'group' => $groups);
		$this->set_response($user, REST_Controller::HTTP_OK);
	}

	public function edit_put()
	{
		$id =  $this->getLoggedUserID();
		$username = $this->getLoggedUserName();
		$password = $this->put('new_password');
		$email = $this->put('email');
		$first_name = $this->put('first_name');
		$last_name = $this->put('last_name');

		$user = array(
					 'first_name' => $first_name,
					 'last_name' => $last_name,
					 'password' => $password,
					 'email' => $email
						);

		 $this->ion_auth->update($id, $user);
		 $this->set_response(array('username' => $username), REST_Controller::HTTP_OK);
	}




private function validateUser()
{

	$this->ion_auth->username_check($this->username);
	$this->ion_auth->email_check($this->userEmail);
	$this->ion_auth->identity_check($this->username);



return TRUE;

}

}
