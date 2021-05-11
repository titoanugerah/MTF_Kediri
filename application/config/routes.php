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

#BANK
$route['bank'] = 'bank';
$route['api/bank/read'] = 'bank/read';
$route['api/bank/readDetail'] = 'bank/readDetail';
$route['api/bank/recover'] = 'bank/recover';
$route['api/bank/create'] = 'bank/create';
$route['api/bank/delete'] = 'bank/delete';
$route['api/bank/update'] = 'bank/update';

#AREA
$route['area'] = 'area';
$route['api/area/read'] = 'area/read';
$route['api/area/readDetail'] = 'area/readDetail';
$route['api/area/recover'] = 'area/recover';
$route['api/area/create'] = 'area/create';
$route['api/area/delete'] = 'area/delete';
$route['api/area/update'] = 'area/update';

#FAMILY STATUS
$route['familyStatus'] = 'familyStatus';
$route['api/familyStatus/read'] = 'familyStatus/read';
$route['api/familyStatus/readDetail'] = 'familyStatus/readDetail';
$route['api/familyStatus/recover'] = 'familyStatus/recover';
$route['api/familyStatus/create'] = 'familyStatus/create';
$route['api/familyStatus/delete'] = 'familyStatus/delete';
$route['api/familyStatus/update'] = 'familyStatus/update';

#POSITION
$route['position'] = 'position';
$route['api/position/read'] = 'position/read';
$route['api/position/readDetail'] = 'position/readDetail';
$route['api/position/recover'] = 'position/recover';
$route['api/position/create'] = 'position/create';
$route['api/position/delete'] = 'position/delete';
$route['api/position/update'] = 'position/update';

#DISTRICT
$route['district'] = 'district';
$route['api/district/read'] = 'district/read';
$route['api/district/readDetail'] = 'district/readDetail';
$route['api/district/recover'] = 'district/recover';
$route['api/district/create'] = 'district/create';
$route['api/district/delete'] = 'district/delete';
$route['api/district/update'] = 'district/update';

#POSITION
$route['customer'] = 'customer';
$route['api/customer/read'] = 'customer/read';
$route['api/customer/readDetail'] = 'customer/readDetail';
$route['api/customer/recover'] = 'customer/recover';
$route['api/customer/create'] = 'customer/create';
$route['api/customer/delete'] = 'customer/delete';
$route['api/customer/update'] = 'customer/update';


#EMPLOYEE
$route['employee'] = 'employee';
$route['api/employee/read'] = 'employee/read';
$route['api/employee/readDetail'] = 'employee/readDetail';
$route['api/employee/recover'] = 'employee/recover';
$route['api/employee/create'] = 'employee/create';
$route['api/employee/delete'] = 'employee/delete';
$route['api/employee/update'] = 'employee/update';

#PAYROLL PERIOD
$route['payrollperiod'] = 'payrollperiod';
$route['api/payrollperiod/read'] = 'payrollperiod/read';
$route['api/payrollperiod/create'] = 'payrollperiod/create';

#PAYROLL GROUP
$route['payrollgroup/downloadExcelInput/(:any)'] = 'payrollgroup/downloadExcelInput/$1';
$route['payrollgroup/downloadCustomerReport/(:any)'] = 'payrollgroup/downloadCustomerReport/$1';
$route['payrollgroup/uploadExcel'] = 'payrollgroup/uploadExcel';
$route['api/payrollgroup/read'] = 'payrollgroup/read';
$route['api/payrollgroup/readDetail/(:any)'] = 'payrollgroup/readDetail/$1';
$route['api/payrollgroup/create'] = 'payrollgroup/create';
$route['payrollgroup/(:any)'] = 'payrollgroup/index/$1';


#PAYROLL SUBGROUP
$route['payrollsubgroup/(:any)'] = 'payrollsubgroup/index/$1';
$route['payrollsubgroup/downloadExcelInput/(:any)/(:any)'] = 'payrollsubgroup/downloadExcelInput/$1/$2';
$route['api/payrollsubgroup/read'] = 'payrollsubgroup/read';
$route['api/payrollsubgroup/create'] = 'payrollsubgroup/create';

$route['template'] = 'general/template';
$route['404_override'] = 'errors';
$route['translate_uri_dashes'] = FALSE;
