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
$route['gallery/manage'] = 'gallery/manage_gallery';
$route['gallery/manage/create_subgallery'] = 'gallery/create_subgallery';
$route['gallery/manage/upload_image'] = 'gallery/upload_image';
$route['gallery/manage/rm/(:any)'] = 'gallery/rm_subgallery/$1';
$route['gallery/manage/rm/(:any)/(:any)'] = 'gallery/rm_image/$1/$2';
$route['gallery/manage/(:any)'] = 'gallery/manage_subgallery/$1';
$route['gallery'] = 'gallery';
$route['gallery/(:any)'] = 'gallery/subgallery/$1';
$route['news'] = 'news';
$route['news/view/(:any)'] = 'news/view/$1';
$route['news/(:num)'] = 'news/view/$1';
$route['news/create'] = 'news/create';
$route['news/edit'] = 'news/edit';
$route['news/edit/(:num)'] = 'news/edit/$1';
$route['news/edit_news/(:num)'] = 'news/edit_news/$1';
$route['news/delete_news/(:num)'] = 'news/delete_news/$1';
$route['admin'] = 'admin';
$route['admin/go'] = 'admin/go';
$route['admin/logout'] = 'admin/logout';
$route['(:any)'] = 'pages/view/$1';
$route['default_controller'] = 'pages/view';
$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */
