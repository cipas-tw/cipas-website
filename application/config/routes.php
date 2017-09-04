<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
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
$route['default_controller'] = 'home';
$route['404_override'] = 'view404';
$route['translate_uri_dashes'] = FALSE;

$route['news/(:num)'] = "news/detail/$1";
$route['presses/(:num)'] = "presses/detail/$1";
$route['gazettes/(:num)'] = "gazettes/detail/$1";
$route['meetings/(:num)'] = "meetings/detail/$1";
$route['investigations/(:num)'] = "investigations/detail/$1";
$route['hearings/(:num)'] = "hearings/detail/$1";
$route['administrative_actions/(:num)'] = "administrative_actions/detail/$1";
$route['litigations/(:num)'] = "litigations/detail/$1";
$route['declarations/(:num)'] = "declarations/detail/$1";
$route['rewards/(:num)'] = "rewards/detail/$1";
$route['recoveries/(:num)'] = "recoveries/detail/$1";
$route['organic_rules/(:num)'] = "organic_rules/detail/$1";
$route['regulations/(:num)'] = "regulations/detail/$1";
$route['interpretations/(:num)'] = "interpretations/detail/$1";
$route['purchases/(:num)'] = "purchases/detail/$1";
$route['policies/(:num)'] = "policies/detail/$1";
$route['statistics/(:num)'] = "statistics/detail/$1";
$route['journals/(:num)'] = "journals/detail/$1";
$route['videos/(:num)'] = "videos/detail/$1";
$route['stories/(:num)'] = "stories/detail/$1";
$route['api/about/members'] = "api/about_members";




$route['organize.action'] = 'about';
$route['staff.action'] = 'about/members';
$route['activity.action'] = 'news';
$route['law.action'] = 'news/detail/75';
$route['news.action'] = 'gazettes';
$route['meeting.action'] = 'meetings';
$route['video.action'] = 'videos';

$id = isset($_GET['id']) ? $_GET['id'] : 0;
$route['newsView.action'] = 'redirects/newsview/'.$id;
$route['activityView.action'] = 'redirects/activityview/'.$id;
$route['lawView.action'] = 'redirects/lawview/'.$id;
$route['meetingView.action'] = 'redirects/meetingview/'.$id;
