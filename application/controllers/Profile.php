<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('profile_model');
  }

  public function index()
  {
    $this->load->view('shared/template', $this->profile_model->content());
  }

}

?>
