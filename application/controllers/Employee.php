<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('core_model');
    $this->load->model('employee_model');
  }

  public function index()
  {
    $this->load->view('shared/template', $this->employee_model->content());
  }


  #API
  public function read()
  {
    echo $this->employee_model->read();
  }

  public function readDetail()
  {
    echo $this->employee_model->readDetail();
  }

  public function recover()
  {
    echo $this->employee_model->recover();
  }

  public function create()
  {
    echo $this->employee_model->create();
  }

  public function update()
  {
    echo $this->employee_model->update();
  }

  public function delete()
  {
    echo $this->employee_model->delete();
  }

}

 ?>
