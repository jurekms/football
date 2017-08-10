<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'libraries/MY_REST_Controller.php');



class User extends MY_REST_Controller {
	private $jwtToken;

	public function __construct()
	{
		parent::__construct();

  }


	public function adminEdit_get()
	{
		$groups = [];
		$id = $this->get('id') == -1 ? $this->getLoggedUserID() : $this->get('id');
		$groupsIonAuth = (array)$this->ion_auth->get_users_groups($id)->result();
		foreach ($groupsIonAuth as $group){
			$groupIonAuth = (array)$group;
			$groups[] = $groupIonAuth['id'];
		};
		$userIonAuth =(array) $this->ion_auth->user($id)->row();
		$user =array( 'id' => $userIonAuth['id'], 'username' => $userIonAuth['username'], 'first_name' => $userIonAuth['first_name'], 'last_name' => $userIonAuth['last_name'], 'email' => $userIonAuth['email'], 'group' => $groups);
		$this->set_response($user, REST_Controller::HTTP_OK);
	}



	public function adminEdit_put()
	{
		$id = $this->put('id');
		$username = $this->put('username');
		$password = $this->put('new_password');
		$email = $this->put('email');
		$first_name = $this->put('first_name');
		$last_name = $this->put('last_name');
	  $group = $this->put('group');
		$user = array(
					 'first_name' => $first_name,
					 'last_name' => $last_name,
					 'password' => $password,
					 'email' => $email
						);
		 $this->ion_auth->remove_from_group(NULL, $id);
		 $this->ion_auth->add_to_group($group, $id);
		 $this->ion_auth->update($id, $user);
		 $this->set_response(array('username' => $username), REST_Controller::HTTP_OK);
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


}
