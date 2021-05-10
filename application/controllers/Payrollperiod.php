<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payrollperiod extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('core_model');
    $this->load->model('payrollperiod_model');
    error_reporting($this->config->item('error_reporting'));
  }

  public function index(){
    $this->load->view('shared/template', $this->payrollperiod_model->content());
  }


  #API
  public function read()
  {
    echo $this->payrollperiod_model->read();
  }

  public function create()
  {
    echo $this->payrollperiod_model->create();
  }

}

 ?>
