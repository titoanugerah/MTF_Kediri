<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model
{

  function __construct()
  {
    parent::__construct();
    if (!$this->session->userdata('isLogin'))
    {
      require_once 'vendor/autoload.php';
      $client = new Google_Client();
      $client->setAuthConfig('assets/client_credentials.json');
      $client->addScope("email");
      $client->addScope("profile");
      $this->session->set_flashdata('link', $client->createAuthUrl());  
    }
  }

  public function content()
  {
    try
    {
      $data['contact'] = $this->core_model->readSingleData('contact','id', 1);
      $data['product'] = $this->core_model->readAllData('product');
      $data['viewName'] = 'product/index';
      return $data;
    }
    catch (Exception $ex)
    {
      notify("Gagal", "Terjadi kendala disaat akses halaman : ".$ex->getMessage(), "danger", "fa fa-times", null);
    }
  }

  public function detail($id)
  {
    try
    {
      $data['contact'] = $this->core_model->readSingleData('contact','id', 1);

      $data['content'] = $this->core_model->readSingleData('product', 'id', $id);
      $data['viewName'] = 'product/detail';
//      var_dump($data['content']->description);die;
      return $data;
    }
    catch (Exception $ex)
    {
      notify("Gagal", "Terjadi kendala disaat akses halaman : ".$ex->getMessage(), "danger", "fa fa-times", null);
    }
  }

}

?>
