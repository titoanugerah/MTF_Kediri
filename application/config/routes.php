<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'dashboard';
$route['dashboard'] = 'dashboard';
$route['profile'] = 'profile';
$route['login'] = 'auth/login';
$route['logout'] = 'auth/logout';

#HOME CMS
$route['homeCMS'] = 'homeCMS';
$route['api/homeCMS/read'] = 'homeCMS/read';
$route['api/homeCMS/update'] = 'homeCMS/update';

#TERMS CMS
$route['termsCMS'] = 'termsCMS';
$route['api/termsCMS/read'] = 'termsCMS/read';
$route['api/termsCMS/update'] = 'termsCMS/update';
$route['api/termsCMS/upload'] = 'termsCMS/upload';

#PRODUCT CMS
$route['productCMS'] = 'productCMS';
$route['api/productCMS/read'] = 'productCMS/read';
$route['api/productCMS/readDetail/(:any)'] = 'productCMS/readDetail/$1';
$route['api/productCMS/update'] = 'productCMS/update';
$route['api/productCMS/create'] = 'productCMS/create';
$route['api/productCMS/delete'] = 'productCMS/delete';
$route['api/productCMS/upload/(:any)'] = 'productCMS/upload/$1';

#CONTACT CMS
$route['contactCMS'] = 'contactCMS';
$route['api/contactCMS/read'] = 'contactCMS/read';
$route['api/contactCMS/update'] = 'contactCMS/update';
$route['api/contactCMS/upload'] = 'contactCMS/upload';

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
