<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('auth_model');
  }

  public function login()
  {
    $this->auth_model->login();
  }

  public function logout()
  {
    $this->auth_model->logout();
  }

}


 ?>
