<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('core_model');
    $this->load->model('page_model');
    error_reporting($this->config->item('error_reporting'));
  }

  public function index($id){
   $this->load->view('shared/frontEnd', $this->page_model->content($id));
  }

}

 ?>
