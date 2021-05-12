<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OtherPageCMS extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('core_model');
    $this->load->model('otherPageCMS_model');
    error_reporting($this->config->item('error_reporting'));
  }

  public function index(){
    $this->load->view('shared/template', $this->otherPageCMS_model->content());
  }


  #API
  public function create()
  {
    echo $this->otherPageCMS_model->create();
  }

  public function read()
  {
    echo $this->otherPageCMS_model->read();
  }

  public function update()
  {
    echo $this->otherPageCMS_model->update();
  }

  public function readDetail($id)
  {
    echo $this->otherPageCMS_model->readDetail($id);
  }

  public function upload($id)
  {
    echo $this->otherPageCMS_model->upload($id);
  }

  public function updateAttachment()
  {
    echo $this->otherPageCMS_model->updateAttachment();
  }

  public function uploadAttachment($id)
  {
    echo $this->otherPageCMS_model->uploadAttachment($id);
  }

  public function delete()
  {
    echo $this->otherPageCMS_model->delete();
  }

  public function deleteAttachment()
  {
    echo $this->otherPageCMS_model->deleteAttachment();
  }
}

 ?>
