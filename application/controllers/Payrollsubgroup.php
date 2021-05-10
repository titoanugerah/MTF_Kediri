<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payrollsubgroup extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('core_model');
    $this->load->model('payrollsubgroup_model');
    error_reporting($this->config->item('error_reporting'));
  }

  public function index($id){
    $this->load->view('shared/template', $this->payrollsubgroup_model->content($id));
  }

  public function downloadExcelInput($id,$customerId)
  {
    return $this->payrollsubgroup_model->downloadExcelInput($id, $customerId);
  }

  #API
  public function read()
  {
    echo $this->payrollsubgroup_model->read();
  }

}

 ?>
