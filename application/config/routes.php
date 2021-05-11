<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'dashboard';
$route['dashboard'] = 'dashboard';
$route['profile'] = 'profile';
$route['login'] = 'auth/login';
$route['logout'] = 'auth/logout';

#ROLE
$route['role'] = 'role';
$route['api/role/read'] = 'role/read';
$route['api/role/readDetail'] = 'role/readDetail';
$route['api/role/recover'] = 'role/recover';
$route['api/role/create'] = 'role/create';
$route['api/role/delete'] = 'role/delete';
$route['api/role/update'] = 'role/update';



$route['template'] = 'general/template';
$route['404_override'] = 'errors';
$route['translate_uri_dashes'] = FALSE;
