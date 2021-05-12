<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OtherPageCms_model extends CI_Model
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
        $data['viewName'] = 'otherPageCMS/index';
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
      return json_encode($this->core_model->createData('page', $this->input->post()));
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
      $data = $this->core_model->readAllData('page');
      return json_encode($data);
 
    }
    catch (Exception $ex)
    {
      notify("Gagal", "Terjadi kendala disaat memuat data konten : ".$ex->getMessage(), "danger", "fa fa-times", null);
    }
  }

  public function readDetail($id)
  {
    try
    {
      $data['otherPage'] = $this->core_model->readSingleData('page', 'id', $id);
      $data['attachment'] = $this->core_model->readSomeData('attachment', 'attachmentCategoryId', 2, 'targetId', $id);
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
      $input = $this->input->post();
      if ($this->session->userdata('roleId')== $this->config->item('admin_role_id') && $input['id'] != 0)
      {
        return json_encode($this->core_model->updateDataBatch('page',  'id', $input['id'], $this->input->post()));
      }
    }
    catch (Exception $ex)
    {
      notify("Gagal", "Terjadi kendala disaat update data konten : ".$ex->getMessage(), "danger", "fa fa-times", null);
    }
  }

  public function updateAttachment()
  {
    try
    {
      $input = $this->input->post();
      if ($this->session->userdata('roleId')== $this->config->item('admin_role_id') && $input['id'] != 0)
      {
        return json_encode($this->core_model->updateDataBatch('attachment',  'id', $input['id'], $this->input->post()));
      }
    }
    catch (Exception $ex)
    {
      notify("Gagal", "Terjadi kendala disaat update data konten : ".$ex->getMessage(), "danger", "fa fa-times", null);
    }
  }

  public function upload($id)
  {
    try
    {
      $filename = 'otherPage_'.$id;
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
        $this->core_model->UpdateData('page', 'id', $id , 'image', $filename.$upload['ext']);
      }
      return json_encode($upload);
    } 
    catch (Exception $ex)
    {
      notify("Gagal", "Terjadi kendala disaat update data konten : ".$ex->getMessage(), "danger", "fa fa-times", null);
    }
  }

  public function uploadAttachment($id)
  {
    try
    {
      $uploadData = $this->core_model->createData('attachment', array('attachmentCategoryId' => 2, 'targetId' => $id, 'isExist' => 1));
      $filename = 'attachment_otherPage_'.$id.'_'.$uploadData['id'];
      $config['upload_path'] = APPPATH.'../assets/attachment/';
      $config['overwrite'] = TRUE;  
      $config['file_name']     =  str_replace(' ','_',$filename);
      $config['allowed_types'] = 'pdf|xlsx|xls';
      $this->load->library('upload', $config);
      if (!$this->upload->do_upload('file')) {
        $upload['status']= 'danger';
        $upload['message']= "Mohon maaf terjadi error saat proses upload : ".$this->upload->display_errors();
      } else {
        $upload['status']= 'success';
        $upload['message'] = "File berhasil di upload";
        $upload['ext'] = $this->upload->data('file_ext');
        $upload['filename'] = $filename;
        $upload['id'] = $uploadData['id'];
        $this->core_model->UpdateData('attachment', 'id', $uploadData['id'] , 'path', $filename.$upload['ext']);
      }
      return json_encode($upload);
    } 
    catch (Exception $ex)
    {
      notify("Gagal", "Terjadi kendala disaat update data konten : ".$ex->getMessage(), "danger", "fa fa-times", null);
    }
  }

  public function delete()
  {
    return json_encode($this->core_model->forceDeleteData('page', 'id', $this->input->post('id')));
  }

  public function deleteAttachment()
  {
    return json_encode($this->core_model->forceDeleteData('attachment', 'id', $this->input->post('id')));
  }
}

?>
