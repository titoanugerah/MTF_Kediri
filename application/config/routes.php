<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'home';
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
$route['api/productCMS/deleteAttachment'] = 'productCMS/deleteAttachment';
$route['api/productCMS/upload/(:any)'] = 'productCMS/upload/$1';
$route['api/productCMS/uploadAttachment/(:any)'] = 'productCMS/uploadAttachment/$1';
$route['api/productCMS/updateAttachment'] = 'productCMS/updateAttachment';

#Other Page CMS
$route['otherPageCMS'] = 'otherPageCMS';
$route['api/otherPageCMS/read'] = 'otherPageCMS/read';
$route['api/otherPageCMS/readDetail/(:any)'] = 'otherPageCMS/readDetail/$1';
$route['api/otherPageCMS/update'] = 'otherPageCMS/update';
$route['api/otherPageCMS/create'] = 'otherPageCMS/create';
$route['api/otherPageCMS/delete'] = 'otherPageCMS/delete';
$route['api/otherPageCMS/deleteAttachment'] = 'otherPageCMS/deleteAttachment';
$route['api/otherPageCMS/upload/(:any)'] = 'otherPageCMS/upload/$1';
$route['api/otherPageCMS/uploadAttachment/(:any)'] = 'otherPageCMS/uploadAttachment/$1';
$route['api/otherPageCMS/updateAttachment'] = 'otherPageCMS/updateAttachment';

#Referral
$route['referral'] = 'referral';
$route['api/referral/read'] = 'referral/read';
$route['api/referral/update'] = 'referral/update';
$route['api/referral/upload/(:any)'] = 'referral/upload/$1';
$route['api/referral/picture/(:any)'] = 'referral/picture/$1';

#CONTACT CMS
$route['contactCMS'] = 'contactCMS';
$route['api/contactCMS/read'] = 'contactCMS/read';
$route['api/contactCMS/update'] = 'contactCMS/update';
$route['api/contactCMS/upload'] = 'contactCMS/upload';

#HOME
$route['home'] = 'home';

#PRODUCT
$route['product'] = 'product';
$route['product/(:any)'] = 'product/detail/$1';

$route['template'] = 'general/template';
$route['404_override'] = 'errors';
$route['translate_uri_dashes'] = FALSE;
