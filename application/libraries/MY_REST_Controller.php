<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'libraries/REST_Controller.php');
require(APPPATH.'libraries/JWT/JWT.php');
require(APPPATH.'libraries/JWT/SignatureInvalidException.php');
require(APPPATH.'libraries/JWT/ExpiredException.php');


  class MY_REST_Controller extends REST_Controller
  {
  private $jwtTokenEncode;
  private $jwtTokenDecode;
  private $loggedUserID;
  private $loggedUsername;
  private $loggedUserRoles;
  private $requestedMethodName;
  private $globalPrivilages;


  public function __construct($config = 'rest')
  {
    parent::__construct();
    $this->globalPrivilages = array('user' => array(
                                                      'edit_get' => array('admin','members','footballer'),
                                                      'edit_put' => array('admin','members'),
                                                      'add_post' => array('admin', 'members')
                                                    ),
                                    'users' => array(
                                                      'list_get' => array('admin','footballer')
                                                    ),
                                    'group' => array(
                                                      'list_get' => array('admin','members','footballer'),
                                                      'edit_put' => array('admin'),
                                                      'add_post' => array('admin', 'members')
                                                    )
                                  );
    $this->tokenDecode();

    if(!$this->checkPrivilages()){
      $this->response(NULL, 401);
    }
  }






  private function checkPrivilages()
  {

    $classMethodPrivilages = $this->globalPrivilages[$this->router->class][$this->router->method.'_'.$this->input->method()];
    $allow = FALSE;
    foreach($classMethodPrivilages as $role) {
      if(in_array($role, $this->loggedUserRoles)){
          $allow = TRUE;
          continue;
      }
    }
    return $allow;
  }






  protected function tokenDecode()
  {
    $key = "ssssss";
    if(isset($_COOKIE['jwtToken'])) {
      $this->jwtTokenEncode = $_COOKIE['jwtToken'];
    };


    try
    {
      $this->jwtTokenDecode =(array) Firebase\JWT\JWT::decode($this->jwtTokenEncode, $key, array('HS256'));
      $payload = (array)($this->jwtTokenDecode['payload']);
      $this->loggedUserID = $payload['userID'];
      $this->loggedUsername = $payload['username'];
      $this->loggedUserRoles = ($payload['roles']);
      $this->jwtTokenDecode['iat'] = time();
      $this->jwtTokenDecode['exp'] = time()+20;
      $this->jwtTokenEncode = Firebase\JWT\JWT::encode($this->jwtTokenDecode, $key);
      setcookie('jwtToken',$this->jwtTokenEncode,time()+20,'/','',FALSE,TRUE);
    }
    catch ( Exception $e)
    {
      $this->response(array('message' => $e->getMessage()), 401);
      $this->load->helper('url');

    }
  }

  protected function getLoggedUserID(){
    return $this->loggedUserID;
  }




}

  ?>
