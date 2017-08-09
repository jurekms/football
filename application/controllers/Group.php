<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'libraries/MY_REST_Controller.php');



class Group extends MY_REST_Controller {
	private $jwtToken;

	public function __construct()
	{
		parent::__construct();

  }


	public function list_get()
	{
    $groups = $this->ion_auth->groups()->result();
		$groupsList = array(
			'options' => array('nbgroups' => $this->ion_auth->num_rows()),
			'data' => $groups
		);
		$this->set_response($groupsList, REST_Controller::HTTP_OK);
	}



	public function edit_put()
	{
		$this->set_response(NULL, REST_Controller::HTTP_OK);
	}



	public function add_post()
	{
		$this->set_response(NULL, REST_Controller::HTTP_OK);
	}




}
