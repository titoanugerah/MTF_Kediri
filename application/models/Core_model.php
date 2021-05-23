<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Core_model extends CI_Model
{

  function __construct()
  {
    parent::__construct();
  }

  public function readSingleData($table, $whereVar, $whereVal )
  {
    $data = $this->db->get_where($table, $where = array($whereVar => $whereVal ));
    return $data->row();
  }

  public function readSomeData($table, $whereVar, $whereVal )
  {
    $list = $this->db->list_fields($table);
    $keyword = $this->input->post('keyword');
    $likeQuery = "";
    foreach ($list as $item)
    {
      if ($item=='id') {
        
      } else {
        #$this->db->or_like($item, $this->input->post('keyword'));
        $likeQuery = $likeQuery .' '.$item.' LIKE "%'.$keyword.'%" or ';
      }
    }
    $query = 'SELECT * FROM '.$table.' where '.$whereVar.' = '.$whereVal.' and ('.rtrim($likeQuery, 'or ').')';
    $data = $this->db->query($query);
    #$data = $this->db->get_where($table, $where = array($whereVar => $whereVal));
    return $data->result();
  }

  public function readSomeData2($table, $whereVar, $whereVal,$whereVar2, $whereVal2  )
  {
    $list = $this->db->list_fields($table);
    $keyword = $this->input->post('keyword');
    $likeQuery = "";
    foreach ($list as $item)
    {
      if ($item=='id') {
        
      } else {
        #$this->db->or_like($item, $this->input->post('keyword'));
        $likeQuery = $likeQuery .' '.$item.' LIKE "%'.$keyword.'%" or ';
      }
    }
    $query = 'SELECT * FROM '.$table.' where '.$whereVar.' = '.$whereVal.' and '.$whereVar2.' = '.$whereVal2.' and ('.rtrim($likeQuery, 'or ').')';
    $data = $this->db->query($query);
    return $data->result();
  }


  public function readAllData($table)
  {
    $list = $this->db->list_fields($table);
    foreach ($list as $item)
    {
      $this->db->or_like($item, $this->input->post('keyword'));
    }
    $data = $this->db->get($table);
    return $data->result();
  }

  public function readAllDataDatatable($table)
  {
    $list = $this->db->list_fields($table);
    foreach ($list as $item)
    {
      $this->db->or_like($item, $this->input->post('keyword'));
    }
    $data = $this->db->get($table);

    $result['draw'] = $_REQUEST['draw'];
    $result['recordsTotal'] = $data->num_rows();
    $result['recordsFiltered'] = $data->num_rows();
    $result['data'] = $data->result();    

    return $result;
  }


  public function readQueryDataDatatable($query)
  {
    $data = $this->db->query($query);

    $result['draw'] = $_REQUEST['draw'];
    $result['recordsTotal'] = $data->num_rows();
    $result['recordsFiltered'] = $data->num_rows();
    $result['data'] = $data->result();    

    return $result;
  }

  public function countAllData($table)
  {
    $list = $this->db->list_fields($table);
    foreach ($list as $item)
    {
      $this->db->or_like($item, $this->input->post('keyword'));
    }
    $data = $this->db->get($table);
    return $data->num_rows();
  }


  public function recoverData($table, $whereVar, $whereVal)
  {
    $result['isSuccess'] = false;
    $where = array($whereVar => $whereVal );
    $data = array('isExist' => 1 );
    $this->db->where($where);
    $result['isSuccess'] = $this->db->update($table, $data);
    $result['content'] = "Data berhasil dipulihkan";
    return $result;
  }

  public function updateDataBatch($table, $whereVar, $whereVal, $data)
  {
    $result['isSuccess'] = false;
    $where = array($whereVar => $whereVal );
    $this->db->where($where);
    $result['isSuccess'] = $this->db->update($table, $data);
    $result['content'] = "Data berhasil dirubah";
    return $result;
  }

  public function createData($table, $data)
  {
    $result['isSuccess'] = $this->db->insert($table, $data);
    $result['content'] = "Data berhasil ditambahkan";
    $result['id'] = $this->db->insert_id();
    return $result;
  }

  public function createOrUpdate($table, $param, $data)
  {
    if($this->getNumRows($table, $param, $data[$param])>0)
    {
      $this->updateDataBatch($table, $param, $data[$param], $data);
    }
    else
    {
      $this->createData($table, $data);
    }
    return $this->readSingleData($table, $param, $data[$param]);
  }


  public function createOrUpdate2($table, $param1, $param2, $data)
  {
    $currentData = ($this->db->query('select * from '.$table.' where '.$param1.'='.$data[$param1].' and '.$param2.'='.$data[$param2]))->row();
    if($currentData!=null)
    {
      $this->updateDataBatch($table, 'id', $currentData->id, $data);
    }
    else
    {
      $this->createData($table, $data);
    }
    return $currentData = ($this->db->query('select * from '.$table.' where '.$param1.'="'.$data[$param1].'" and '.$param2.'="'.$data[$param2].'"'))->row();
  }


  public function getNumRows($table, $whereVar, $whereVal )
  {
    $data = $this->db->get_where($table, $where = array($whereVar => $whereVal ));
    return $data->num_rows();
  }

  public function getNumRows2($table, $whereVar1, $whereVal1, $whereVar2, $whereVal2 )
  {
    $data = $this->db->get_where($table, $where = array($whereVar1 => $whereVal1,$whereVar2 => $whereVal2 ));
    return $data->num_rows();
  }

  function setResponseCode($code, $message = null) 
  {
    // $code = intval($code);

    // if (version_compare(phpversion(), '5.4', '>') && is_null($reason))
    // {      
    //   http_response_code($code);
    // }
    // else
    // {
    //   header(trim("HTTP/1.0 $code $reason"));      
    // }
    header_remove();
    http_response_code($code);
    header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
    header('Content-Type: application/json');
    header(trim("HTTP/1.0 $code $message"));      

    // $status = array(
    //   200 => '200 OK',
    //   400 => '400 Bad Request',
    //   401 => '401 Unauthorized',
    //   422 => 'Unprocessable Entity',
    //   500 => '500 Internal Server Error'
    //   );
//    header('Status: '.$status[$code]);
    return json_encode
    (
       $message
    );
  } 

  public function get2SelectedData($table1, $table2, $whereVarTable1, $whereValTable1, $joinVarTable1, $joinVarTable2 )
  {
    $query = 'select * FROM '.$table1.' , '.$table2.' where '.$table1.'.'.$whereVarTable1.' = '.$whereValTable1.' and '.$table1.'.'.$joinVarTable1.' = '.$table2.'.'.$joinVarTable2;
    $data = $this->db->query($query);
    return $data->row();
  }

  public function get2SomeData($table1, $table2, $whereVarTable1, $whereValTable1, $joinVarTable1, $joinVarTable2 )
  {
    $query = 'select * FROM '.$table1.' , '.$table2.' where '.$table1.'.'.$whereVarTable1.' = '.$whereValTable1.' and '.$table1.'.'.$joinVarTable1.' = '.$table2.'.'.$joinVarTable2;
    $data = $this->db->query($query);
    return $data->result();
  }

  public function updateData($table, $whereVar, $whereVal, $setVar, $setVal)
  {
    $where = array($whereVar => $whereVal );
    $data = array($setVar => $setVal );
    $this->db->where($where);
    $this->db->update($table, $data);
    $result['content'] = "Data berhasil dirubah";
    return $result;
  }

  public function updateSomeData($table, $whereVar, $whereVal, $setArray)
  {
    $where = array($whereVar => $whereVal );
    $this->db->where($where);
    $this->db->update($table, $setArray);
  }


  public function deleteData($table, $whereVar, $whereVal)
  {
    $data['isSuccess'] = false;
    $where = array($whereVar => $whereVal );
    $data = array('isExist' => 0 );
    $this->db->where($where);
    $result['isSuccess'] = $this->db->update($table, $data);
    $result['content'] = "Data berhasil dihapus";
    return $result;
  }

  public function forceDeleteData($table, $whereVar, $whereVal)
  {
    $data['isSuccess'] = false;
    $where = array($whereVar => $whereVal );
    $result['isSuccess'] = $this->db->delete($table, $where);
    $result['content'] = "Data berhasil dihapus";
    return $result;
  }

  public function forceDeleteData2($table, $whereVar1, $whereVal1, $whereVar2, $whereVal2)
  {
    $data['isSuccess'] = false;
    $where = array($whereVar1 => $whereVal1,$whereVar2 => $whereVal2 );
    $result['isSuccess'] = $this->db->delete($table, $where);
    $result['content'] = "Data berhasil dihapus";
    return $result;
  }

  public function uploadFile($type,$id)
  {

    $filename = $type.'_'.$id;
    $config['upload_path'] =  APPPATH.'../assets/picture/';
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
      $this->updateData($type, 'Id', $id, 'Image', $filename.$upload['ext']);
    }
    return json_encode($upload);
  }


}
 ?>
