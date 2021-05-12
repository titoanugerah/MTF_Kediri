<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductCMS extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('core_model');
    $this->load->model('productCMS_model');
    error_reporting($this->config->item('error_reporting'));
  }

  public function index(){
    $this->load->view('shared/template', $this->productCMS_model->content());
  }


  #API
  public function create()
  {
    echo $this->productCMS_model->create();
  }

  public function read()
  {
    echo $this->productCMS_model->read();
  }

  public function update()
  {
    echo $this->productCMS_model->update();
  }

  public function readDetail($id)
  {
    echo $this->productCMS_model->readDetail($id);
  }

  public function upload($id)
  {
    echo $this->productCMS_model->upload($id);
  }

  public function delete()
  {
    echo $this->productCMS_model->delete();
  }

}

 ?>
