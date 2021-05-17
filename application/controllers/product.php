<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('core_model');
    $this->load->model('product_model');
    error_reporting($this->config->item('error_reporting'));
  }

  public function index(){
   $this->load->view('shared/frontEnd', $this->product_model->content());
  }

}

 ?>
