<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model
{

  function __construct()
  {
    parent::__construct();
  }

  public function content()
  {
    try
    {
      if (!$this->session->userdata('isLogin'))
      {
        require_once 'vendor/autoload.php';
        $client = new Google_Client();
        $client->setAuthConfig('assets/client_credentials.json');
        $client->addScope("email");
        $client->addScope("profile");
        $this->session->set_flashdata('link', $client->createAuthUrl());  
      }

        $data['contact'] = $this->core_model->readSingleData('contact','id', 1);
        $data['content'] = $this->core_model->readSingleData('page','id', 1);
        $data['terms'] = $this->core_model->readSingleData('page','id', 2);
        $data['product'] = $this->core_model->readAllData('product');
        $data['promo'] = $this->core_model->readSomeData('page', 'pageCategoryId', 2);
        $data['program'] = $this->core_model->readSomeData('page', 'pageCategoryId', 3);
        $data['viewName'] = 'home/index';
        return $data;
    }
    catch (Exception $ex)
    {
      notify("Gagal", "Terjadi kendala disaat akses halaman : ".$ex->getMessage(), "danger", "fa fa-times", null);
    }
  }


}

?>
