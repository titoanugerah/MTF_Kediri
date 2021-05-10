<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('core_model');
    error_reporting($this->config->item('error_reporting'));
  }

  public function content()
  {
    try 
    {
      $data['viewName'] = 'dashboard/index';
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
    catch (Exception $ex) 
    {
      notify("Gagal", "Terjadi kendala disaat akses dashboard : ".$ex->getMessage(), "danger", "fa fa-times", null);  
    }
    finally
    {
      return $data;
    }
  }
}

?>
