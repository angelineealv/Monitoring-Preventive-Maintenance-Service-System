<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the Customer guide for complete details:
|
|	https://codeigniter.com/Customer_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['login'] = "Login";
$route['login/auth'] = "Login/ceklogin";

$route['registeration'] = "Regis";
$route['registeration/auth'] = "Regis/cekregis";

$route['forgot'] = "Forgot";
$route['forgot/auth'] = "Forgot/cekforgot";

$route['logout'] = "Login/logout";

$route['home'] = "Home";
//$route['home'] = "Home/dashboard";

$route['master/customer'] = "Master/MasterCustomer";
$route['master/customer/datatables'] = "Master/MasterCustomer/datatables";
$route['master/customer/add'] = "Master/MasterCustomer/add";
$route['master/customer/add/process'] = "Master/MasterCustomer/insertData";
$route['master/customer/edit/(:any)'] = "Master/MasterCustomer/edit/$1";
$route['master/customer/edit/(:any)/process'] = "Master/MasterCustomer/updateData/$1";
$route['master/customer/delete/(:any)'] = "Master/MasterCustomer/deleteData/$1";

$route['master/userlog'] = "Master/MasterUserLog";
$route['master/userlog/datatables'] = "Master/MasterUserLog/datatables";

$route['master/user'] = "Master/MasterUser";
$route['master/user/datatables'] = "Master/MasterUser/datatables";
$route['master/user/add'] = "Master/MasterUser/add";
$route['master/user/add/process'] = "Master/MasterUser/insertData";
$route['master/user/edit/(:any)'] = "Master/MasterUser/edit/$1";
$route['master/user/edit/(:any)/process'] = "Master/MasterUser/updateData/$1";
$route['master/user/delete/(:any)'] = "Master/MasterUser/deleteData/$1";

$route['master/city'] = "Master/MasterCity";
$route['master/city/datatables'] = "Master/MasterCity/datatables";
$route['master/city/add'] = "Master/MasterCity/add";
$route['master/city/add/process'] = "Master/MasterCity/insertData";
$route['master/city/edit/(:any)'] = "Master/MasterCity/edit/$1";
$route['master/city/edit/(:any)/process'] = "Master/MasterCity/updateData/$1";
$route['master/city/delete/(:any)'] = "Master/MasterCity/deleteData/$1";


$route['master/country'] = "Master/MasterCountry";
$route['master/country/datatables'] = "Master/MasterCountry/datatables";
$route['master/country/add'] = "Master/MasterCountry/add";
$route['master/country/add/process'] = "Master/MasterCountry/insertData";
$route['master/country/edit/(:any)'] = "Master/MasterCountry/edit/$1";
$route['master/country/edit/(:any)/process'] = "Master/MasterCountry/updateData/$1";
$route['master/country/delete/(:any)'] = "Master/MasterCountry/deleteData/$1";

$route['master/province'] = "Master/MasterProvince";
$route['master/province/datatables'] = "Master/MasterProvince/datatables";
$route['master/province/add'] = "Master/MasterProvince/add";
$route['master/province/add/process'] = "Master/MasterProvince/insertData";
$route['master/province/edit/(:any)'] = "Master/MasterProvince/edit/$1";
$route['master/province/edit/(:any)/process'] = "Master/MasterProvince/updateData/$1";
$route['master/province/delete/(:any)'] = "Master/MasterProvince/deleteData/$1";
$route['master/province/add'] = "Master/MasterProvince/add";
