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
        $isRegisteredUser = $this->core_model->getNumRows('user', 'email', $validUser->email);
        if ($isRegisteredUser)
        {
          $data = array(
            'name' =>  $validUser->name,
            'image' => $validUser->picture,
          );
          $this->core_model->updateSomeData('user', 'email', $validUser->email, $data);
          $user = $this->core_model->readSingleData('view_user', 'email', $validUser->email);
          if ($user->isExist)
          {
            $userdata = array(
              'isLogin' => true,
              'email' => $user->email,
              'name' => $user->name,
              'image' => $user->image,
              'roleId' => $user->roleId,
              'role' => $user->role,
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
          $data = array(
            'name' =>  $validUser->name,
            'image' => $validUser->picture,
            'email' => $validUser->email,
            'roleId' => $this->config->item('visitor_role_id')
          );
          $this->core_model->createData('user', $data);
          $user = $this->core_model->readSingleData('view_user', 'email', $validUser->email);
          $userdata = array(
            'isLogin' => true,
            'email' => $user->email,
            'name' => $user->name,
            'image' => $user->image,
            'roleId' => $user->roleId,
            'role' => $user->role,
            'isExist' => $user->isExist,
          );
          $this->session->set_userdata($userdata);

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
