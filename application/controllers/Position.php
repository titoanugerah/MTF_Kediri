<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Position extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('core_model');
    $this->load->model('position_model');
    error_reporting($this->config->item('error_reporting'));
  }

  public function index(){
    $this->load->view('shared/template', $this->position_model->content());
  }


  #API
  public function read()
  {
    echo $this->position_model->read();
  }

  public function readDetail()
  {
    echo $this->position_model->readDetail();
  }

  public function recover()
  {
    echo $this->position_model->recover();
  }

  public function create()
  {
    echo $this->position_model->create();
  }

  public function update()
  {
    echo $this->position_model->update();
  }

  public function delete()
  {
    echo $this->position_model->delete();
  }

}

 ?>
