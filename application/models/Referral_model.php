<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Referral_model extends CI_Model
{

  function __construct()
  {
    parent::__construct();
    $this->load->library('Excel');
  }

  public function content()
  {
    try
    {
      if ($this->session->userdata('roleId')== $this->config->item('admin_role_id'))
      {
        $data['viewName'] = 'referral/index';
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
      $data = $this->core_model->readSingleData('contact', 'id', 1);
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
        return json_encode($this->core_model->updateDataBatch('contact',  'id', 1, $this->input->post()));
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
      $filename = 'referral';
      $config['upload_path'] = APPPATH.'../assets/attachment/';
      $config['overwrite'] = TRUE;
  
      $config['file_name']     =  str_replace(' ','_',$filename);
      $config['allowed_types'] = 'xls|xlsx';
      $this->load->library('upload', $config);
      if (!$this->upload->do_upload('file')) {
        $upload['status']= 'danger';
        $upload['message']= "Mohon maaf terjadi error saat proses upload : ".$this->upload->display_errors();
      } else {
        $upload['status']= 'success';
        $upload['message'] = "File berhasil di upload ".$this->extractExcel($id);
        $upload['ext'] = $this->upload->data('file_ext');
        $upload['filename'] = $filename;
//       $this->extractExcel($id);
       // $this->core_model->UpdateData('contact', 'id', 1, 'image', $filename.$upload['ext']);
      }
      return json_encode($upload);
    } 
    catch (Exception $ex)
    {
      notify("Gagal", "Terjadi kendala disaat update data konten : ".$ex->getMessage(), "danger", "fa fa-times", null);
    }

  }

  public function extractExcel($month)
  {
    $id = ($this->core_model->createOrUpdate('referral', 'month', array('month' => $month)))->id;

    $excelReader = PHPExcel_IOFactory::createReader('Excel2007');
    $excelReader->setReadDataOnly(true);
    $excel = $excelReader->load(APPPATH.'../assets/attachment/referral.xlsx');
    $sheet = $excel->getSheetByName('MTF YTD KEDIRI');
    
    $highestRow = $sheet->getHighestRow(); 
    $highestColumn = $sheet->getHighestColumn();
    for ($i = 8; $i <= $highestRow; $i++){ 
      $record;
      $branch;
      $branch['code'] = $sheet->getCell('J'.$i)->getValue();
      if($branch['code']==null){
        break;
      }
      $branch['name'] = $sheet->getCell('K'.$i)->getValue();
      $class['name'] = $sheet->getCell('L'.$i)->getValue();
      $referralDetail['prospectUnit'] = ($sheet->getCell('M'.$i)->getValue());
      $referralDetail['prospectAmount'] = ($sheet->getCell('N'.$i)->getValue());
      $referralDetail['goLiveUnit'] = ($sheet->getCell('O'.$i)->getValue());
      $referralDetail['goLiveAmount'] = ($sheet->getCell('P'.$i)->getValue());
      $newClass = $this->core_model->createOrUpdate('class', 'name', $class);
      $branch['classId'] = $newClass->id;
      $newBranch = $this->core_model->createOrUpdate('branch', 'code', $branch);
      $referralDetail['referralId'] = $id;
      $referralDetail['branchCode'] = $sheet->getCell('J'.$i)->getValue();  
      $newReferralDetail = $this->core_model->createOrUpdate2('referralDetail', 'referralId', 'branchCode', $referralDetail);
    }
    $this->core_model->updateData('referralDetail', 'prospectUnit', null, 'prospectUnit', 0);      
    $this->core_model->updateData('referralDetail', 'prospectAmount', null, 'prospectAmount', 0);      
    $this->core_model->updateData('referralDetail', 'goLiveUnit', null, 'goLiveUnit', 0);      
    $this->core_model->updateData('referralDetail', 'goLiveAmount', null, 'goLiveAmount', 0);      
    return true;      
  }

  public function checkIfNull($value)
  {
    if($value == "" or $value=" " or $value == null)  {
      return 12;
    } else {
      return $value;
    }
  }

}

?>
