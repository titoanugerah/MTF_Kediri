<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('core_model');
    $this->load->model('customer_model');
    error_reporting($this->config->item('error_reporting'));
  }

  public function index(){
    $this->load->view('shared/template', $this->customer_model->content());
  }


  #API
  public function read()
  {
    echo $this->customer_model->read();
  }

  public function readDetail()
  {
    echo $this->customer_model->readDetail();
  }

  public function recover()
  {
    echo $this->customer_model->recover();
  }

  public function create()
  {
    echo $this->customer_model->create();
  }

  public function update()
  {
    echo $this->customer_model->update();
  }

  public function delete()
  {
    echo $this->customer_model->delete();
  }

}

 ?>
