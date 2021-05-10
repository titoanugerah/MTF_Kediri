<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payrollgroup_model extends CI_Model
{

  function __construct()
  {
    parent::__construct();
    $this->load->library('Excel');

  }

  public function content($id)
  {
    try
    {
      if ($this->session->userdata('roleId') == $this->config->item('admin_role_id'))
      {
        $data['viewName'] = 'payrollgroup/index';
        $data['period'] = ($this->db->query('select id, monthname(period) as month, year(period) as year from payrollperiod where id ='.$id))->row();
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
        $query = $this->db->query('select * from payrollgroup where year(period) = '.date('Y').' and monthname(period) = "'.date("F", strtotime('m')).'"');
        $isExist = ($query)->num_rows();
        if($isExist==0)
        {
          $data = array
          (
            'period' => date("Y-m-d")
          );
          $id = $this->core_model->createData('payrollgroup', $data)['id'];
          foreach($this->core_model->readAllData('customer') as $customer)
          {
            $payrollGroup = array 
            (
              'payrollGroupId' => $id,
              'customerId' => $customer->id,              
            );
            $payrollGroupId = $this->core_model->createData('payrollgroup', $payrollGroup)['id'];
            $districts = ($this->db->query('select distinct a.districtId, b.umk, c.flatInsentive from employee as a inner join district as b on (a.districtId = b.id) inner join area as c on (b.areaId = c.id)  where customerId = '.$customer->id.' order by districtId asc'))->result();
            foreach($districts as $district)
            {
              $payrollSubGroup = array
              (
                'payrollGroupId' => $payrollGroupId,
                'districtId' => $district->districtId,
                'mainSalary' => $district->umk,
                'flatInsentive' => $district->flatInsentive,                
              );
              $payrollSubGroupId = $this->core_model->createData('payrollsubgroup', $payrollSubGroup)['id'];
              $employees = ($this->db->query('select nik from employee where customerId = '.$customer->id.' and districtId = '.$district->districtId.' order by nik asc'))->result();
              foreach($employees as $employee)
              {
                $payrollDetail = array
                (
                  'payrollSubGroupId' => $payrollSubGroupId,
                  'employeeId' => $employee->nik,           
                );
                $result = $this->core_model->createData('payrollDetail', $payrollDetail);
              }
            }
          }
          return json_encode($result);
        } 
        else
        {
          return $this->core_model->setResponseCode(404, "Data sudah tersedia");          
        }
      } 
      else 
      {
        return $this->core_model->setResponseCode(401, "Anda tidak diijinkan mengakses fitur ini");
      }
    }
    catch (Exception $ex)
    {
      notify("Gagal", "Terjadi kendala disaat membuat data payrollgroup : ".$ex->getMessage(), "danger", "fa fa-times", null);
    }
  }

  public function read()
  {
    try
    {
      $query = 'select b.payrollGroupId as id,  a.id as customerId, a.name as customer, b.status from customer as a inner join payrollsubgroup as b on (a.id = b.customerId) group by a.id';
      $data = $this->core_model->readQueryDataDatatable($query);            
    }
    catch (Exception $ex)
    {
      notify("Gagal", "Terjadi kendala disaat memuat data payrollsubgroup : ".$ex->getMessage(), "danger", "fa fa-times", null);
    }
    finally
    {
      return json_encode($data);
    }
  }

  public function uploadExcel()
  {
    try 
    {
      $config['upload_path']   = APPPATH.'../assets/excel/';
      $config['overwrite'] = TRUE;
      $config['allowed_types'] = 'xlsx|xls';    
      $config['file_name']     = "ExcelInput";
      $this->load->library('upload', $config);
      if($this->upload->do_upload('fileUpload'))
      {
        $phpExcel = new PHPExcel();
        $phpExcel = PHPExcel_IOFactory::load('./assets/excel/ExcelInput.xls');
        $totalSheet = $phpExcel->getSheetCount();
  
        for ($currentSheet=0; $currentSheet < $totalSheet; $currentSheet++) 
        { 
          $phpExcel->setActiveSheetIndex($currentSheet);
          $sheet = $phpExcel->getActiveSheet();
          for ($currentRow=4; $currentRow <= $sheet->getHighestRow(); $currentRow++) 
          {
            $data = array
            (
              'totalWorkingDay' => $sheet->getCell('F'.(string)($currentRow))->getValue(),
              'totalOtTime' => $sheet->getCell('G'.(string)($currentRow))->getValue(),
              'rapel' => $sheet->getCell('H'.(string)($currentRow))->getValue(),
              'voucherInsentive' => $sheet->getCell('I'.(string)($currentRow))->getValue(),
              'otherInsentive' => $sheet->getCell('J'.(string)($currentRow))->getValue(),
              'remark' => $sheet->getCell('K'.(string)($currentRow))->getValue(),
              'apd' => $sheet->getCell('L'.(string)($currentRow))->getValue(),
              'uniform' => $sheet->getCell('M'.(string)($currentRow))->getValue(),
              'backup' => $sheet->getCell('N'.(string)($currentRow))->getValue(),
              'incident' => $sheet->getCell('O'.(string)($currentRow))->getValue(),
              'otherDeduction' => $sheet->getCell('P'.(string)($currentRow))->getValue(),
              'otherDeductionRemark' => $sheet->getCell('Q'.(string)($currentRow))->getValue(),
              'status' => 2,            
            );
            $id = $sheet->getCell('E'.(string)($currentRow))->getValue();
            $this->core_model->updateDataBatch('payrolldetail', 'id', $id, $data); 
          }
          $id = $sheet->getCell('Q1')->getValue();
          $this->core_model->updateData('payrollgroup', 'id', $id, 'status', 2); 
        }
        $payrollgroup = $this->core_model->readSingleData('payrollgroup', 'id', $id);
//        $this->core_model->updateData('payrollgroup', 'id', $payrollgroup->id, 'status', 2);
        notify("Sukses", "File Excel berhasil terupload", "success", "fa fa-check", ('payrollgroup/'.$payrollgroup->payrollPeriodId));
      } 
      else
      {
        notify("Gagal", "Terjadi kendala disaat upload data excel : ".$this->upload->display_errors(), "danger", "fa fa-times", null);
      }
    } 
    catch (Exception $ex)
    {
      notify("Gagal", "Terjadi kendala disaat upload data excel : ".$ex->getMessage(), "danger", "fa fa-times", null);
    }
  }

  public function downloadCustomerReport($id)
  {
    $employeePayrolls = $this->core_model->readSomeData('viewpayrollinput', 'payrollGroupId', $id);
    foreach ($employeePayrolls as $employeePayroll) 
    {
      $payroll = array 
      (
        'bpjsCashback' => $employeePayroll->defaultMainSalary*0.1089,
        'mainSalary' => $employeePayroll->defaultMainSalary,
        'flatInsentive' =>  
      );
    }
  }

  public function downloadExcelInput($id)
  {
    $phpExcel = new PHPExcel();
    $phpExcel = PHPExcel_IOFactory::load('./assets/excel/InputTemplate.xlsx');
    $template = $phpExcel ->getActiveSheet()->copy();
    $areaId = 0;
    $row = 4;
    $employeePayrolls = $this->core_model->readSomeData('viewPayrollInput', 'payrollGroupId', $id);
    foreach($employeePayrolls as $employeePayroll)
    {
      if($areaId!=$employeePayroll->areaId)
      {
        $row=4;
        $areaId = $employeePayroll->areaId;
        $sheet = clone $template;
        $sheet->setTitle($employeePayroll->area);
        $phpExcel->addSheet($sheet);
        $phpExcel->setActiveSheetIndexByName($employeePayroll->area);    
        $phpExcel->getActiveSheet()->setCellValue('D1', $employeePayroll->month.' '.$employeePayroll->year); 
        $phpExcel->getActiveSheet()->setCellValue('J1', $employeePayroll->customer); 
        $phpExcel->getActiveSheet()->setCellValue('Q1', $employeePayroll->payrollGroupId);         
      }

      $phpExcel->getActiveSheet()->setCellValue('A' . (string)($row), $employeePayroll->employeeId); 
      $phpExcel->getActiveSheet()->setCellValue('B' . (string)($row), $employeePayroll->employee); 
      $phpExcel->getActiveSheet()->setCellValue('C' . (string)($row), $employeePayroll->district); 
      $phpExcel->getActiveSheet()->setCellValue('D' . (string)($row), $employeePayroll->position); 
      $phpExcel->getActiveSheet()->setCellValue('E' . (string)($row), $employeePayroll->id); 
      $phpExcel->getActiveSheet()->setCellValue('F' . (string)($row), $employeePayroll->totalWorkingDay); 
      $phpExcel->getActiveSheet()->setCellValue('G' . (string)($row), $employeePayroll->totalOtTime); 
      $phpExcel->getActiveSheet()->setCellValue('H' . (string)($row), $employeePayroll->rapel); 
      $phpExcel->getActiveSheet()->setCellValue('I' . (string)($row), $employeePayroll->voucherInsentive); 
      $phpExcel->getActiveSheet()->setCellValue('J' . (string)($row), $employeePayroll->otherInsentive); 
      $phpExcel->getActiveSheet()->setCellValue('K' . (string)($row), $employeePayroll->remark); 
      $phpExcel->getActiveSheet()->setCellValue('L' . (string)($row), $employeePayroll->apd); 
      $phpExcel->getActiveSheet()->setCellValue('M' . (string)($row), $employeePayroll->uniform); 
      $phpExcel->getActiveSheet()->setCellValue('N' . (string)($row), $employeePayroll->backup);
      $phpExcel->getActiveSheet()->setCellValue('O' . (string)($row), $employeePayroll->incident); 
      $phpExcel->getActiveSheet()->setCellValue('P' . (string)($row), $employeePayroll->otherDeduction); 
      $phpExcel->getActiveSheet()->setCellValue('Q' . (string)($row), $employeePayroll->otherDeductionRemark); 
      $row++;
      
    }
    $phpExcel->setActiveSheetIndexByName('TEMP');
    $sheetIndex = $phpExcel->getActiveSheetIndex();
    $phpExcel->removeSheetByIndex($sheetIndex);
    $filename = $employeePayroll->customer.'_'.$employeePayroll->month.$employeePayroll->year;
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header("Content-Disposition: attachment; filename=$filename.xls");
    header('Cache-Control: max-age=0');
    header ('Expires: Mon, 26 Jul 2019 05:00:00 GMT'); // Date in the past
    header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
    header ('Cache-Control: no-cache, must-revalidate'); // HTTP/1.1
    header ('Pragma: public'); // HTTP/1.0
    $objWriter = PHPExcel_IOFactory::createWriter($phpExcel, 'Excel5');
    $objWriter->save('php://output');
    return true;
  }



  public function readDetail($id)
  {
    try
    {
      $data = $this->core_model->readQueryDataDatatable('select a.id, a.payrollPeriodId, a.customerId, c.name as customer, a.isExist, a.status, count(b.id) as district from payrollgroup as a left join payrollsubgroup as b on (a.id = b.payrollGroupId) left join customer as c on (a.customerId = c.id) where a.id = '.$id.' group by a.id  ');
    }
    catch (Exception $ex)
    {
      notify("Gagal", "Terjadi kendala disaat memuat data payrollgroup : ".$ex->getMessage(), "danger", "fa fa-times", null);
    }
    finally
    {
      return json_encode($data);
    }
  }


}

?>
