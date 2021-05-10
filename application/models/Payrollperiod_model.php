<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payrollperiod_model extends CI_Model
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
        $data['viewName'] = 'payrollperiod/index';
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
        $query = $this->db->query('select * from payrollperiod where year(period) = '.date('Y').' and monthname(period) = "'.date("F", strtotime('m')).'"');
        $isExist = ($query)->num_rows();
        if($isExist==0)
        {
          $data = array
          (
            'period' => date("Y-m-d")
          );
          $id = $this->core_model->createData('payrollperiod', $data)['id'];
          foreach($this->core_model->readAllData('customer') as $customer)
          {
            $payrollGroup = array 
            (
              'payrollPeriodId' => $id,
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
      notify("Gagal", "Terjadi kendala disaat membuat data payrollperiod : ".$ex->getMessage(), "danger", "fa fa-times", null);
    }
  }

  public function read()
  {
    try
    {
      $data = $this->core_model->readQueryDataDatatable('select *, year(period) as year, monthname(period) as month FROM payrollperiod');

    }
    catch (Exception $ex)
    {
      notify("Gagal", "Terjadi kendala disaat memuat data payrollperiod : ".$ex->getMessage(), "danger", "fa fa-times", null);
    }
    finally
    {
      return json_encode($data);
    }
  }


}

?>
