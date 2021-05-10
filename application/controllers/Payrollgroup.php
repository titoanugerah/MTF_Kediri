<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payrollgroup extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('core_model');
    $this->load->model('payrollgroup_model');
    error_reporting($this->config->item('error_reporting'));
  }

  public function index($id)
  {
    
    if($this->input->post())
    {
      $this->payrollgroup_model->uploadExcel();      
    } 
    else 
    {
      $this->load->view('shared/template', $this->payrollgroup_model->content($id));
    }
  }


  #API
  public function read()
  {
    echo $this->payrollgroup_model->read();
  }

  public function readDetail($id)
  {
    echo $this->payrollgroup_model->readDetail($id);
  }

  public function downloadExcelInput($id)
  {
    return $this->payrollgroup_model->downloadExcelInput($id);
  }

  public function downloadCustomerReport($id)
  {
    return $this->payrollgroup_model->downloadCustomerReport($id);
  }
  
  public function create()
  {
    echo $this->payrollgroup_model->create();
  }

}

 ?>
