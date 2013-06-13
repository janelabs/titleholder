<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "main";
$route['404_override'] = '';


// login
$route['login'] = "login/index";
$route['logout'] = "login/logout";

// signup
$route['signup'] = "register/index";
$route['ranking'] = "rankings/index";

// battle
$route['battle'] = "battle/index";
$route['battle/fight'] = "battle/view";

// logs
$route['logs/(:num)'] = "logs/index/$1";
$route['logs'] = "history/index";
$route['logs/battle/players'] = "history/players";
$route['logs/battle/monsters'] = "history/monsters";
$route['logs/quest'] = "history/quests";

// cms
$route['cms/login'] = 'cms_login';
$route['cms/main'] = 'cms_admin';
$route['cms/authenticate'] = 'cms_login/authenticate';
$route['cms/logout'] = 'cms_login/logout';
$route['cms/users'] = 'cms_users';
$route['cms/users/all'] = 'cms_users/fetchUsers';
$route['cms/users/delete/(:num)'] = 'cms_users/deleteUser/$1';

/* End of file routes.php */
/* Location: ./application/config/routes.php */