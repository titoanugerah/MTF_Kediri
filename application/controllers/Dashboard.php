<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('dashboard_model');
  }

  public function index()
  {
  $this->load->view('shared/template', $this->dashboard_model->content());
  }

}

?>
