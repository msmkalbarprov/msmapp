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
// $route['proyek'] = 'ProyekController/index';
// $route['proyek/tambah-proyek'] = 'ProyekController/add';
// $route['proyek/simpan-proyek']['post'] = 'ProyekController/add';
// $route['proyek/edit-proyek/(:any)'] = 'ProyekController/edit/$1';
// $route['proyek/delete-proyek/(:any)'] = 'ProyekController/delete/$1';
// $route['proyek/view-proyek/(:any)'] = 'ProyekController/view/$1';
// $route['proyek/tambah-rincian-proyek/(:any)'] = 'ProyekController/addRincian/$1';
// $route['proyek/edit-proyek-rincian/(:any)'] = 'ProyekController/editRincian/$1';
// $route['proyek/delete-proyek-rincian/(:any)'] = 'ProyekController/deleterincian/$1';



$route['proyek'] 								= 'proyek/index';
$route['proyek/add'] 							= 'proyek/tambah_proyek';
$route['proyek/edit/(:any)'] 					= 'proyek/edit_proyek/$1';
$route['proyek/delete/(:any)'] 					= 'proyek/delete_proyek/$1';
$route['proyek/view/(:any)'] 					= 'proyek/view_proyek/$1';
$route['proyek/addrincian/(:any)'] 				= 'proyek/add_rincian_proyek/$1';
$route['proyek/editrincian/(:any)'] 			= 'proyek/edit_rincian_proyek/$1';
$route['proyek/deleterincian/(:any)'] 			= 'proyek/delete_rincian_proyek/$1';


$route['pq'] 									= 'pq/index';
$route['pq/add'] 								= 'pq/tambah_pq';
$route['pq/edit/(:any)'] 						= 'pq/edit_pq/$1';
$route['pq/delete/(:any)'] 						= 'pq/delete_pq/$1';
$route['pq/view/(:any)'] 						= 'pq/view_pq/$1';

// HPP
$route['pq/add_hpp/(:any)'] 					= 'pq/add_hpp/$1';
$route['pq/edit_hpp/(:any)/(:any)'] 			= 'pq/ubah_hpp/$1';
$route['pq/del_hpp/(:any)/(:any)'] 				= 'pq/hapus_hpp/$1';

$route['pq/datatable_json_operasional'] 		= 'pq/datatable_json_operasional';

$route['pq/add_operasional'] 					= 'pq/add_pq_operasional';
$route['pq/editrincian/(:any)'] 				= 'pq/edit_rincian_pq/$1';
$route['pq/deleterincian/(:any)'] 				= 'pq/delete_rincian_pq/$1';

// sah pq
$route['bod/view/(:any)'] 						= 'bod/view_pq/$1';


// PDO
$route['pdo'] 									= 'cpdo/index';
$route['pdo/add'] 								= 'cpdo/add';
$route['pdo/delete_pdo_project/(:any)']			= 'cpdo/delete_pdo_project/$1';
$route['pdo/edit_pdo_project/(:any)']			= 'cpdo/edit_pdo_project/$1';
$route['pdo/operasional']						= 'cpdo/operasional';
$route['pdo/add_operasional']					= 'cpdo/add_operasional';
$route['pdo/edit_pdo_operasional/(:any)']		= 'cpdo/edit_pdo_operasional/$1';

$route['pdo/datatable_json/(:any)']				= 'cpdo/datatable_json/$1';
$route['pdo/datatable_json']					= 'cpdo/datatable_json';
$route['pdo/get_item_pq_by_pq']					= 'cpdo/get_item_pq_by_pq';
$route['pdo/get_nilai']							= 'cpdo/get_nilai';
$route['pdo/get_nilai2']						= 'cpdo/get_nilai2';
$route['pdo/get_realisasi']						= 'cpdo/get_realisasi';
$route['pdo/get_realisasi2']					= 'cpdo/get_realisasi2';
$route['pdo/get_nomor']							= 'cpdo/get_nomor';
$route['pdo/get_pq_projek_by_area']				= 'cpdo/get_pq_projek_by_area';

$route['pencairan/detail/(:any)']				= 'pencairan/edit_proyek/$1';


$route['pengeluaran_lain_area'] 								= 'pengeluaran_lain_area/index';
$route['pengeluaran_lain_area/add'] 							= 'pengeluaran_lain_area/add';
$route['pengeluaran_lain_area/edit/(:any)'] 					= 'pengeluaran_lain_area/edit/$1';
$route['pengeluaran_lain_area/delete/(:any)'] 					= 'pengeluaran_lain_area/delete/$1';

$route['penerimaan_lain_area'] 								= 'penerimaan_lain_area/index';
$route['penerimaan_lain_area/add'] 							= 'penerimaan_lain_area/add';
$route['penerimaan_lain_area/edit/(:any)'] 					= 'penerimaan_lain_area/edit/$1';
$route['penerimaan_lain_area/delete/(:any)'] 					= 'penerimaan_lain_area/delete/$1';





$route['default_controller'] = 'home';
// $route['default_controller'] = 'maintenance';
$route['admin'] = 'admin/dashboard';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Admin Locations
$route['admin/location/country/add'] = 'admin/location/country_add';
$route['admin/location/country/edit/(:num)'] = 'admin/location/country_edit/$1';
$route['admin/location/country/del/(:num)'] = 'admin/location/country_del/$1';
$route['admin/location/state/add'] = 'admin/location/state_add';
$route['admin/location/state/edit/(:num)'] = 'admin/location/state_edit/$1';
$route['admin/location/state/del/(:num)'] = 'admin/location/state_del/$1';
$route['admin/location/city/add'] = 'admin/location/city_add';
$route['admin/location/city/edit/(:num)'] = 'admin/location/city_edit/$1';
$route['admin/location/city/del/(:num)'] = 'admin/location/city_del/$1';



$route['karyawan-spj_pegawai-get-rincian'] 					= 'Spj_pegawai/get_rincian';
$route['laporan-Realisasi/list-acc'] 						= 'RealProyekRinciController/list_acc';
$route['laporan-Realisasi/list-area'] 						= 'RealProyekRinciController/list_area';

$route['laporan-Realisasi/list-proyek'] 					= 'RealProyekRinciController/list_proyek';

//$route[EncryptLink('kapip-laptri-teknologi-informasi')] 							= 'laporan/LaptriTeknologiInformasiController/index';

$route['laporan-rinci-realisasi-proyek-pdo-prev'] 									= 'RealProyekRinciController/prev_laporan_pdo';
$route['laporan-rinci-realisasi-proyek-pdo-pdf/(:any)/(:any)/(:any)/(:any)'] 		= 'RealProyekRinciController/pdf_laporan_pdo/$1/$2/$3/$4';
$route['laporan-rinci-realisasi-proyek-pdo-excel/(:any)/(:any)/(:any)/(:any)'] 		= 'RealProyekRinciController/excel_laporan_pdo/$1/$2/$3/$4';


$route['laporan-rinci-realisasi-proyek-spj-prev'] 									= 'RealProyekRinciController/prev_laporan_spj';
$route['laporan-rinci-realisasi-proyek-spj-pdf/(:any)/(:any)/(:any)/(:any)'] 		= 'RealProyekRinciController/pdf_laporan_spj/$1/$2/$3/$4';
$route['laporan-rinci-realisasi-proyek-spj-excel/(:any)/(:any)/(:any)/(:any)'] 		= 'RealProyekRinciController/excel_laporan_spj/$1/$2/$3/$4';


$route['laporan-realisasi-rap-prev'] 												= 'RealProyekRinciController/prev_laporan_rap';
$route['laporan-realisasi-rap-pdf/(:any)/(:any)/(:any)/(:any)'] 					= 'RealProyekRinciController/pdf_laporan_rap/$1/$2/$3/$4';
$route['laporan-realisasi-rap-excel/(:any)/(:any)/(:any)/(:any)'] 					= 'RealProyekRinciController/excel_laporan_rap/$1/$2/$3/$4';



function EncryptLink($link='')
{
	$res = str_replace('=','',base64_encode($link));
	return $res;
}