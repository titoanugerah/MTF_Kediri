<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeCMS extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('core_model');
    $this->load->model('homeCMS_model');
    error_reporting($this->config->item('error_reporting'));
  }

  public function index(){
    $this->load->view('shared/template', $this->homeCMS_model->content());
  }


  #API
  public function read()
  {
    echo $this->homeCMS_model->read();
  }

  public function update()
  {
    echo $this->homeCMS_model->update();
  }

}

 ?>
