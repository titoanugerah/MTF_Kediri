<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('core_model');
    $this->load->model('role_model');
    error_reporting($this->config->item('error_reporting'));
  }

  public function index(){
    $this->load->view('shared/template', $this->role_model->content());
  }


  #API
  public function read()
  {
    echo $this->role_model->read();
  }

  public function readDetail()
  {
    echo $this->role_model->readDetail();
  }

  public function recover()
  {
    echo $this->role_model->recover();
  }

  public function create()
  {
    echo $this->role_model->create();
  }

  public function update()
  {
    echo $this->role_model->update();
  }

  public function delete()
  {
    echo $this->role_model->delete();
  }

}

 ?>
