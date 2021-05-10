<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Auth_model extends CI_Model
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('core_model');
    error_reporting($this->config->item('error_reporting'));
  }

  public function logout()
  {
    try 
    {
      $this->session->sess_destroy();
      redirect(base_url());
    } 
    catch (Exception $ex) 
    {
      notify('Gagal', "Terjadi kendala disaat Proses Logout : ".$ex->getMessage(), 'danger', 'fa fa-times', '' );
    }
  }

  public function login()
  {
    try 
    {
      require_once 'vendor/autoload.php';
      $client = new Google_Client();
      $client->setAuthConfig('assets/client_credentials.json');
      $client->addScope("email");
      $client->addScope("profile");
      
      if ((!$this->session->userdata('isLogin')) && (isset($_GET['code'])))
      {
        $token = $client->fetchAccessTokenWithAuthCode($this->input->get('code'));
        $client->setAccessToken($token['access_token']);
        $validUser = (new Google_Service_Oauth2($client))->userinfo->get();
        $isRegisteredUser = $this->core_model->getNumRows('employee', 'email', $validUser->email);
        if ($isRegisteredUser)
        {
          $data = array(
            'name' =>  $validUser->name,
            'image' => $validUser->picture,
          );
          $this->core_model->updateSomeData('employee', 'email', $validUser->email, $data);
          $user = $this->core_model->readSingleData('viewEmployee', 'email', $validUser->email);
          if ($user->isExist)
          {
            $userdata = array(
              'isLogin' => true,
              'nik' => $user->nik,
              'email' => $user->email,
              'name' => $user->name,
              'image' => $user->image,
              'roleId' => $user->roleId,
              'role' => $user->role,
              'positionId' => $user->positionId,
              'position' => $user->position,              
              'customerId' => $user->customerId,
              'customer' => $user->customer,
              'districtId' => $user->districtId,
              'district' => $user->district,
              'areaId' => $user->areaId,
              'area' => $user->area,
              'bankId' => $user->bankId,
              'bank' => $user->bank,
              'bankFullName' => $user->bankFullName,
              'accountNumber' => $user->accountNumber,
              'familyStatusId' => $user->familyStatusId,
              'familyStatus' => $user->familyStatus,
              'umr' => $user->umr,
              'umk' => $user->umk,
              'insentive' => $user->insentive,
              'premium' => $user->premium,
              'flatInsentive' => $user->flatInsentive,
              'phoneInsentive' => $user->phoneInsentive,
              'limitIncome' => $user->limitIncome,
              'isRegisteredBpjs' => $user->isRegisteredBpjs,
              'startContract' => $user->startContract,
              'endContract' => $user->endContract,
              'isExist' => $user->isExist,
            );
            $this->session->set_userdata($userdata);
            notify('Berhasil', 'Login berhasil, Selamat datang '.$this->session->userdata('name'), 'success', 'fa fa-user','dashboard');
          }
          else
          {
            notify('Gagal', 'Akun anda sudah tidak aktif, silahkan hubungi Admin', 'danger', 'fa fa-user', '');
          }
        }
        else
        {
          notify('Gagal', 'Akun anda tidak terdaftar di sistem kami, silahkan hubungi Admin', 'danger', 'fa fa-user', '');
        }
      }   
    } 
    catch (Exception $ex) 
    {
      notify('Gagal', "Terjadi kendala disaat Proses Logout : ".$ex->getMessage(), 'danger', 'fa fa-times', '' );
    }
  }
}

 ?>
