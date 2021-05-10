<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Area extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('core_model');
    $this->load->model('area_model');
    error_reporting($this->config->item('error_reporting'));
  }

  public function index(){
    $this->load->view('shared/template', $this->area_model->content());
  }


  #API
  public function read()
  {
    echo $this->area_model->read();
  }

  public function readDetail()
  {
    echo $this->area_model->readDetail();
  }

  public function recover()
  {
    echo $this->area_model->recover();
  }

  public function create()
  {
    echo $this->area_model->create();
  }

  public function update()
  {
    echo $this->area_model->update();
  }

  public function delete()
  {
    echo $this->area_model->delete();
  }

}

 ?>
