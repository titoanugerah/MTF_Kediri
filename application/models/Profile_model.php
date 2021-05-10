<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Profile_model extends CI_Model
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
      $data['viewName'] = 'profile/index';
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
