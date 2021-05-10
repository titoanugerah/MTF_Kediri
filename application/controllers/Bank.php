<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bank extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('core_model');
    $this->load->model('bank_model');
    error_reporting($this->config->item('error_reporting'));
  }

  public function index(){
    $this->load->view('shared/template', $this->bank_model->content());
  }


  #API
  public function read()
  {
    echo $this->bank_model->read();
  }

  public function readDetail()
  {
    echo $this->bank_model->readDetail();
  }

  public function recover()
  {
    echo $this->bank_model->recover();
  }

  public function create()
  {
    echo $this->bank_model->create();
  }

  public function update()
  {
    echo $this->bank_model->update();
  }

  public function delete()
  {
    echo $this->bank_model->delete();
  }

}

 ?>
