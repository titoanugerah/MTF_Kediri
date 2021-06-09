<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('core_model');
    $this->load->model('home_model');
    error_reporting($this->config->item('error_reporting'));
  }

  public function index(){
    if($this->input->post('signUp')){
      $this->home_model->signUp();
    } 
    $this->load->view('shared/frontEnd', $this->home_model->content());
  }

}

 ?>
