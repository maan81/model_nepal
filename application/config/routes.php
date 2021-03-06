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

$route['admin'] = 'admin/admin'; 	//admin's root class
$route['admin/main'] = 'admin/admin/main';
$route['admin/reset_user'] = 'admin/admin/reset_user';

$route['admin/models'] = 'admin/subjects';
$route['admin/models/(:any)'] = 'admin/subjects/$1';
$route['admin/models/(:any)/(:any)'] = 'admin/subjects/$1/$2';

$route['admin/(:any)'] = 'admin/$1';
$route['admin/(:any)/(:any)'] = 'admin/$1/$2';
$route['admin/(:any)/(:any)/(:any)'] = 'admin/$1/$2/$3';

$route['models'] = 'site/subjects';
$route['models/(:any)'] = 'site/subjects/get/$1';
$route['models/(:any)/(:any)'] = 'site/subjects/get/$1/$2';
$route['models/(:any)/(:any)/(:any)'] = 'site/subjects/get/$1/$2/$3';

$route['featured'] = 'site/featured';
$route['featured/(:any)'] = 'site/featured/get/$1';
$route['featured/(:any)/(:any)'] = 'site/featured/get/$1/$2';
$route['featured/(:any)/(:any)/(:any)'] = 'site/featured/get/$1/$2/$3';

$route['events'] = 'site/events';
$route['events/(:any)'] = 'site/events/get/$1';
$route['events/(:any)/(:any)'] = 'site/events/get/$1/$2';
$route['events/(:any)/(:any)/(:any)'] = 'site/events/get/$1/$2/$3';


$route['contests'] = 'site/contests';
$route['contests/(:any)'] = 'site/contests/get/$1';
$route['contests/(:any)/(:any)'] = 'site/contests/get/$1/$2';
$route['contests/(:any)/(:any)/(:any)'] = 'site/contests/get/$1/$2/$3';


$route['news'] = 'site/news';
$route['news/(:any)'] = 'site/news/get/$1';
$route['news/(:any)/(:any)'] = 'site/news/get/$1/$2';
$route['news/(:any)/(:any)/(:any)'] = 'site/news/get/$1/$2/$3';


$route['search'] = 'site/search';

$route['default_controller'] = 'main';
$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */
