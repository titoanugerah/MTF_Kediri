<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TermsCMS extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('core_model');
    $this->load->model('termsCMS_model');
    error_reporting($this->config->item('error_reporting'));
  }

  public function index(){
    $this->load->view('shared/template', $this->termsCMS_model->content());
  }


  #API
  public function read()
  {
    echo $this->termsCMS_model->read();
  }

  public function update()
  {
    echo $this->termsCMS_model->update();
  }

  public function upload()
  {
    echo $this->termsCMS_model->upload();
  }

}

 ?>
