<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FamilyStatus extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('core_model');
    $this->load->model('familyStatus_model');
    error_reporting($this->config->item('error_reporting'));
  }

  public function index(){
    $this->load->view('shared/template', $this->familyStatus_model->content());
  }


  #API
  public function read()
  {
    echo $this->familyStatus_model->read();
  }

  public function readDetail()
  {
    echo $this->familyStatus_model->readDetail();
  }

  public function recover()
  {
    echo $this->familyStatus_model->recover();
  }

  public function create()
  {
    echo $this->familyStatus_model->create();
  }

  public function update()
  {
    echo $this->familyStatus_model->update();
  }

  public function delete()
  {
    echo $this->familyStatus_model->delete();
  }

}

 ?>
