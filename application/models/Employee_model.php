<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee_model extends CI_Model
{

  function __construct()
  {
    parent::__construct();
  }

  public function content()
  {
    try
    {
      if ($this->session->userdata('roleId')== $this->config->item('admin_role_id'))
      {
        $data['viewName'] = 'employee/index';
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

  public function create()
  {
    try
    {
      if ($this->session->userdata('roleId')== $this->config->item('admin_role_id'))
      {
        if($this->input->post('roleId')!=0){
          $data = $this->input->post();
          return json_encode($this->core_model->createData('employee', $data));
        } else {
          return http_response_code(403);
        }
      }
    }
    catch (Exception $ex)
    {
      notify("Gagal", "Terjadi kendala disaat akses halaman : ".$ex->getMessage(), "danger", "fa fa-times", null);
    }
      
  }
  public function read()
  {
    try
    {
      $data['employee'] = $this->core_model->readAllData('employee');
      return json_encode($data);
    }
    catch (Exception $ex)
    {
      notify("Gagal", "Terjadi kendala disaat akses halaman : ".$ex->getMessage(), "danger", "fa fa-times", null);
    }

  }

  public function readDetail()
  {
    try
    {
      $data['detail'] = $this->core_model->readSingleData('viewEmployee', 'nik', $this->input->post('nik'));
      return json_encode($data);
    }
    catch (Exception $ex)
    {
      notify("Gagal", "Terjadi kendala disaat akses halaman : ".$ex->getMessage(), "danger", "fa fa-times", null);
    }
  }

  public function update()
  {
    try
    {
      if ($this->session->userdata('roleId')== $this->config->item('admin_role_id'))
      {
        return json_encode($this->core_model->updateDataBatch('employee',  'nik', $this->input->post('nik'), $this->input->post()));
      }
    }
    catch (Exception $ex)
    {
      notify("Gagal", "Terjadi kendala disaat akses halaman : ".$ex->getMessage(), "danger", "fa fa-times", null);
    }
    
  }

  public function recover()
  {
    try 
    {
      if ($this->session->userdata('roleId')== $this->config->item('admin_role_id'))
      {
        return json_encode($this->core_model->recoverData('employee', 'nik', $this->input->post('nik')));
      }
    }
    catch (Exception $ex)
    {
      notify("Gagal", "Terjadi kendala disaat akses halaman : ".$ex->getMessage(), "danger", "fa fa-times", null);
    }
  }

  public function delete()
  {
    try 
    {
      if ($this->session->userdata('roleId') == $this->config->item('admin_role_id'))
      {
      return json_encode($this->core_model->deleteData('employee', 'nik', $this->input->post('nik')));
      }
    }
    catch (Exception $ex)
    {
      notify("Gagal", "Terjadi kendala disaat akses halaman : ".$ex->getMessage(), "danger", "fa fa-times", null);
    }    
  }




}

?>
