<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Position_model extends CI_Model
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
        $data['viewName'] = 'position/index';
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
        return json_encode($this->core_model->createData('position',  $this->input->post()));
      }

    }
    catch (Exception $ex)
    {
      notify("Gagal", "Terjadi kendala disaat membuat data position : ".$ex->getMessage(), "danger", "fa fa-times", null);
    }
  }

  public function read()
  {
    try
    {
      $data['position'] = $this->core_model->readAllData('position');
    }
    catch (Exception $ex)
    {
      notify("Gagal", "Terjadi kendala disaat memuat data position : ".$ex->getMessage(), "danger", "fa fa-times", null);
    }
    finally
    {
      return json_encode($data);
    }
  }

  public function readDetail()
  {
    try
    {
      $data['detail'] = $this->core_model->readSingleData('position', 'id', $this->input->post('id'));
      return json_encode($data);
    }
    catch (Exception $ex)
    {
      notify("Gagal", "Terjadi kendala disaat memuat data position : ".$ex->getMessage(), "danger", "fa fa-times", null);
    }
  }

  public function update()
  {
    try
    {
      if ($this->session->userdata('roleId')== $this->config->item('admin_role_id'))
      {
        return json_encode($this->core_model->updateDataBatch('position',  'id', $this->input->post('id'), $this->input->post()));
      }
    }
    catch (Exception $ex)
    {
      notify("Gagal", "Terjadi kendala disaat update data position : ".$ex->getMessage(), "danger", "fa fa-times", null);
    }
  }

  public function recover()
  {
    try
    {
      if ($this->session->userdata('roleId')== $this->config->item('admin_role_id'))
      {
       return json_encode($this->core_model->recoverData('position', 'id', $this->input->post('id')));
      }
    }
    catch (Exception $ex)
    {
      notify("Gagal", "Terjadi kendala disaat memulihkan data position : ".$ex->getMessage(), "danger", "fa fa-times", null);
    }
  }

  public function delete()
  {
    try
    {
      if ($this->session->userdata('roleId')== $this->config->item('admin_role_id'))
      {
        return json_encode($this->core_model->deleteData('position', 'id', $this->input->post('id')));
      } 
      else 
      {
        return http_response_code(401);
      }
    }
    catch (Exception $ex)
    {
      notify("Gagal", "Terjadi kendala disaat memulihkan data position : ".$ex->getMessage(), "danger", "fa fa-times", null);
    }
  }

}

?>
