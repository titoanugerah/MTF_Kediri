<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TermsCMS_model extends CI_Model
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
        $data['viewName'] = 'termsCMS/index';
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

  public function read()
  {
    try
    {
      $data = $this->core_model->readSingleData('page', 'id', 2);
      return json_encode($data);
 
    }
    catch (Exception $ex)
    {
      notify("Gagal", "Terjadi kendala disaat memuat data konten : ".$ex->getMessage(), "danger", "fa fa-times", null);
    }
  }

  public function update()
  {
    try
    {
      if ($this->session->userdata('roleId')== $this->config->item('admin_role_id'))
      {
        return json_encode($this->core_model->updateDataBatch('page',  'id', $this->input->post('id'), $this->input->post()));
      }
    }
    catch (Exception $ex)
    {
      notify("Gagal", "Terjadi kendala disaat update data konten : ".$ex->getMessage(), "danger", "fa fa-times", null);
    }
  }

  public function upload()
  {
    try
    {
      $filename = 'terms';
      $config['upload_path'] = APPPATH.'../assets/picture/';
      $config['overwrite'] = TRUE;
  
      $config['file_name']     =  str_replace(' ','_',$filename);
      $config['allowed_types'] = 'jpg|png|jpeg';
      $this->load->library('upload', $config);
      if (!$this->upload->do_upload('file')) {
        $upload['status']= 'danger';
        $upload['message']= "Mohon maaf terjadi error saat proses upload : ".$this->upload->display_errors();
      } else {
        $upload['status']= 'success';
        $upload['message'] = "File berhasil di upload";
        $upload['ext'] = $this->upload->data('file_ext');
        $upload['filename'] = $filename;
        $this->core_model->UpdateData('page', 'id', 2, 'image', $filename.$upload['ext']);
      }
      return json_encode($upload);
    } 
    catch (Exception $ex)
    {
      notify("Gagal", "Terjadi kendala disaat update data konten : ".$ex->getMessage(), "danger", "fa fa-times", null);
    }

  }

}

?>
