<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payrollsubgroup_model extends CI_Model
{

  function __construct()
  {
    parent::__construct();
  }

  public function content($id)
  {
    try
    {
      if ($this->session->userdata('roleId')== $this->config->item('admin_role_id'))
      {
        $data['viewName'] = 'payrollsubgroup/index';
        $data['payrollgroup'] = $this->core_model->readSingleData('viewPayrollGroup', 'id', $id);
        return $data;
      }
      else
      {
        notify("Tidak Ada Akses", "Mohon maaf anda tidak memiliki hak akses untuk dapat mengakses halaman ini, silahkan hubungi IT Admin atau Super Admin", "danger", "fas fa-ban", "dashboard" );
      }
    }
    catch (Exception $ex)
    {
      notify("Gagal", "Terjadi kendala disaat akses halaman : ".$ex->getMessage(), "danger", "fa fa-times", null);
    }
  }
  

?>
