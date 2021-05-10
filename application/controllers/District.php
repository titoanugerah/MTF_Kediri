<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class District extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('core_model');
    $this->load->model('district_model');
    error_reporting($this->config->item('error_reporting'));
  }

  public function index(){
    $this->load->view('shared/template', $this->district_model->content());
  }


  #API
  public function read()
  {
    echo $this->district_model->read();
  }

  public function readDetail()
  {
    echo $this->district_model->readDetail();
  }

  public function recover()
  {
    echo $this->district_model->recover();
  }

  public function create()
  {
    echo $this->district_model->create();
  }

  public function update()
  {
    echo $this->district_model->update();
  }

  public function delete()
  {
    echo $this->district_model->delete();
  }

}

 ?>
