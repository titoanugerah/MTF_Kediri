<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Referral extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('core_model');
    $this->load->model('referral_model');
    error_reporting($this->config->item('error_reporting'));
  }

  public function index(){
    $this->load->view('shared/template', $this->referral_model->content());
  }


  #API
  public function read()
  {
    echo $this->referral_model->read();
  }

  public function update()
  {
    echo $this->referral_model->update();
  }

  public function upload()
  {
    echo $this->referral_model->upload();
  }

}

 ?>
