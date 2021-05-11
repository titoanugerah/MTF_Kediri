<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ContactCMS extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('core_model');
    $this->load->model('contactCMS_model');
    error_reporting($this->config->item('error_reporting'));
  }

  public function index(){
    $this->load->view('shared/template', $this->contactCMS_model->content());
  }


  #API
  public function read()
  {
    echo $this->contactCMS_model->read();
  }

  public function update()
  {
    echo $this->contactCMS_model->update();
  }

  public function upload()
  {
    echo $this->contactCMS_model->upload();
  }

}

 ?>
