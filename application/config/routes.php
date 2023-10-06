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


// master
	// area
	// subarea
	$route['sub-area'] 																		= 'subarea/index';
	$route['sub-area/add'] 																	= 'subarea/add';
	$route['sub-area/edit/(:any)'] 															= 'subarea/edit/$1';
	$route['sub-area/delete/(:any)'] 														= 'subarea/delete/$1';
	// perusahaan
	$route['perusahaan'] 																	= 'perusahaan/index';
	$route['perusahaan/add'] 																= 'perusahaan/add';
	$route['perusahaan/edit/(:any)'] 														= 'perusahaan/edit/$1';
	$route['perusahaan/delete/(:any)'] 														= 'perusahaan/delete/$1';
	// skpd
	$route['skpd'] 																			= 'dinas/index';
	$route['skpd/add'] 																		= 'dinas/add';
	$route['skpd/edit/(:any)'] 																= 'dinas/edit/$1';
	$route['skpd/delete/(:any)'] 															= 'dinas/delete/$1';
	// sub proyek
	$route['sub-proyek'] 																	= 'aplikasi/index';
	$route['sub-proyek/add'] 																= 'aplikasi/add';
	$route['sub-proyek/edit/(:any)'] 														= 'aplikasi/edit/$1';
	$route['sub-proyek/delete/(:any)'] 														= 'aplikasi/delete/$1';
	// sub proyek
	$route['sub-proyek'] 																	= 'aplikasi/index';
	$route['sub-proyek/add'] 																= 'aplikasi/add';
	$route['sub-proyek/edit/(:any)'] 														= 'aplikasi/edit/$1';
	$route['sub-proyek/delete/(:any)'] 														= 'aplikasi/delete/$1';
	// bank
	$route['bank'] 																			= 'bank/index';
	$route['bank/add'] 																		= 'bank/add';
	$route['bank/edit/(:any)'] 																= 'bank/edit/$1';
	$route['bank/delete/(:any)'] 															= 'bank/delete/$1';
	// pegawai
	$route['karyawan'] 																		= 'pegawai/index';
	$route['karyawan/add'] 																	= 'pegawai/add';
	$route['karyawan/edit/(:any)'] 															= 'pegawai/edit/$1';
	$route['karyawan/delete/(:any)'] 														= 'pegawai/delete/$1';
	// penandatangan
	$route['penandatangan'] 																= 'ttd/index';
	$route['penandatangan/edit/(:any)'] 													= 'ttd/edit/$1';
	// saldo awal
	$route['saldo-awal'] 																	= 'saldo_awal/index';
	$route['saldo-awal/add'] 																= 'saldo_awal/add';
	$route['saldo-awal/edit/(:any)'] 														= 'saldo_awal/edit/$1';
	$route['saldo-awal/delete/(:any)'] 														= 'saldo_awal/delete/$1';
	// proyek
	$route['pekerjaan'] 																	= 'proyek/index';
	$route['pekerjaan/add'] 																= 'proyek/tambah_proyek';
	$route['pekerjaan/edit/(:any)'] 														= 'proyek/edit_proyek/$1';
	$route['pekerjaan/delete/(:any)'] 														= 'proyek/delete_proyek/$1';
	$route['pekerjaan/view/(:any)'] 														= 'proyek/view_proyek/$1';
	$route['pekerjaan/addrincian/(:any)'] 													= 'proyek/add_rincian_proyek/$1';
	$route['pekerjaan/editrincian/(:any)'] 													= 'proyek/edit_rincian_proyek/$1';
	$route['pekerjaan/deleterincian/(:any)'] 												= 'proyek/delete_rincian_proyek/$1';
	$route['pekerjaan/batal/(:any)'] 														= 'proyek/batal/$1';
	// pencairan proyek
	$route['pencairan/detail/(:any)']														= 'pencairan/edit_proyek/$1';

// pengajuan
	// PQ
	//project 
	$route['project-qualifying'] 															= 'pq/index';
	$route['project-qualifying/add'] 														= 'pq/tambah_pq';
	$route['project-qualifying/edit/(:any)'] 												= 'pq/edit_pq/$1';
	$route['project-qualifying/delete/(:any)'] 												= 'pq/delete_pq/$1';
	$route['project-qualifying/view/(:any)'] 												= 'pq/view_pq/$1';
	$route['project-qualifying/cetak_pq_satuan/(:any)'] 									= 'pq/cetak_pq_satuan/$1';
	

	// operasional
	$route['project-qualifying/add_operasional'] 											= 'pq/add_pq_operasional';
	$route['project-qualifying/edit_pq_operasional/(:any)'] 								= 'pq/edit_pq_operasional/$1';
	$route['project-qualifying/edit_rincian_pq_operasional/(:any)/(:any)'] 					= 'pq/edit_rincian_pq_operasional/$1/$2';
	$route['project-qualifying/deleterincian/(:any)'] 										= 'pq/delete_rincian_pq/$1';

	// HPP
	$route['project-qualifying/add_hpp/(:any)'] 											= 'pq/add_hpp/$1';
	$route['project-qualifying/edit_hpp/(:any)/(:any)'] 									= 'pq/ubah_hpp/$1';
	$route['project-qualifying/del_hpp/(:any)/(:any)'] 										= 'pq/hapus_hpp/$1';
	// PDO
	// project
	$route['pdo-proyek'] 																	= 'cpdo/index';
	$route['pdo-proyek/add'] 																= 'cpdo/add';
	$route['pdo-proyek/delete/(:any)']														= 'cpdo/delete_pdo_project/$1';
	$route['pdo-proyek/edit/(:any)']														= 'cpdo/edit_pdo_project/$1';
	$route['pdo-proyek/Delete_pdo_project_temp/(:any)']										= 'cpdo/Delete_pdo_project_temp/$1';
	$route['pdo-proyek/Delete_pdo_project_temp2']									        = 'cpdo/Delete_pdo_project_temp2';
	$route['pdo-proyek/Edit_pdo_keterangan/(:any)']											= 'cpdo/Edit_pdo_keterangan/$1';

	// operasional
	$route['pdo-operasional']																= 'cpdo/operasional';
	$route['pdo-operasional/add']															= 'cpdo/add_operasional';
	$route['pdo-operasional/edit/(:any)']													= 'cpdo/edit_pdo_operasional/$1';
	$route['pdo-operasional/Delete_pdo_project_temp/(:any)']								= 'cpdo/Delete_pdo_project_temp/$1';
	$route['pdo-operasional/Delete_pdo_project_temp2']								        = 'cpdo/Delete_pdo_project_temp2';
	$route['pdo-operasional/Edit_pdo_keterangan/(:any)']									= 'cpdo/Edit_pdo_keterangan/$1';
	$route['pdo-operasional/delete/(:any)']													= 'cpdo/delete_pdo_project/$1';

	// gaji
	$route['pdo-gaji']																		= 'cpdo/gaji';
	$route['pdo-gaji/add']																	= 'cpdo/add_gaji';
	$route['pdo-gaji/edit/(:any)']															= 'cpdo/edit_pdo_gaji/$1';
	$route['pdo-gaji/delete_pdo_project_temp/(:any)/(:any)/(:any)']						    = 'cpdo/Delete_pdo_project_temp/$1/$2/$3';
	$route['pdo-gaji/delete_pdo_project_temp2']										        = 'cpdo/Delete_pdo_project_temp2';
	$route['pdo-gaji/edit_pdo_keterangan/(:any)']											= 'cpdo/Edit_pdo_keterangan/$1';
	$route['pdo-gaji/delete/(:any)']														= 'cpdo/delete_pdo_project/$1';

	

	// cetak pdo
	$route['pdo-proyek/cetak_pdo/(:any)']													= 'cpdo/cetak_pdo/$1';
	$route['pdo-operasional/cetak_pdo_operasional/(:any)']									= 'cpdo/cetak_pdo_operasional/$1';
	$route['pdo-gaji/cetak_pdo_gaji/(:any)']												= 'cpdo/cetak_pdo_gaji/$1';
	
	

	
	
	

// transaksi
// tahun lalu
$route['penerimaan_pembayaran_hutang_tahun_lalu'] 											= 'pembayaranTahunLalu/list_terima';
$route['penerimaan_pembayaran_hutang_tahun_lalu/terima/(:any)'] 							= 'pembayaranTahunLalu/terima/$1';

// pengembalian pinjaman
$route['pengembalian-pinjaman']																= 'pinjaman/pengembalian';
$route['pengembalian-pinjaman/add']															= 'pinjaman/add_pengembalian';
$route['pengembalian-pinjaman/edit/(:any)']													= 'pinjaman/edit/$1';
$route['pengembalian-pinjaman/delete/(:any)']												= 'pinjaman/delete/$1';



// bod
$route['pengesahan-pdo-proyek'] 															= 'pengesahan_pdo/index';
$route['pengesahan-pdo-operasional'] 														= 'pengesahan_pdo/operasional';
$route['pengesahan-pdo-gaji'] 																= 'pengesahan_pdo/gaji';
$route['pengesahan-pq-proyek'] 																= 'bod/index';
$route['pengesahan-pq-operasional'] 														= 'bod/operasional';


// BUD
$route['pembayaran_hutang_tahun_lalu'] 														= 'pembayaranTahunLalu/index';
$route['pembayaran_hutang_tahun_lalu/add'] 													= 'pembayaranTahunLalu/add';
$route['pembayaran_hutang_tahun_lalu/edit/(:any)'] 											= 'pembayaranTahunLalu/edit/$1';
$route['pembayaran_hutang_tahun_lalu/delete/(:any)']										= 'pembayaranTahunLalu/delete/$1';
$route['pembayaran_hutang_tahun_lalu/potongan/(:any)'] 										= 'pembayaranTahunLalu/potongan/$1';
$route['pembayaran_hutang_tahun_lalu/delete_potongan/(:any)/(:any)']						= 'pembayaranTahunLalu/delete_potongan/$1/$2';

// laporan
// PQ-PDO
$route['laporan_pq_proyek'] 																= 'laporan_pq/index';
$route['laporan_pq_proyek/cetak_pq_pdo_proyek/(:any)/(:any)/(:any)'] 						= 'laporan_pq/cetak_pq_pdo_proyek/$1/$2/$3';
$route['laporan_pq_proyek/cetak_pq_pdo_all/(:any)/(:any)/(:any)/(:any)'] 					= 'laporan_pq/cetak_pq_pdo_all/$1/$2/$3/$4';
// laporan_pq_proyek/cetak_pq_pdo_proyek/32/2023/1/Laporan%20PQ%20VS%20PDO%20VS%20SPJ
$route['laporan_pq_operasional'] 															= 'laporan_pq/operasional';
$route['laporan_pq_operasional/cetak_pq_pdo_operasional/(:any)/(:any)/(:any)/(:any)'] 		= 'laporan_pq/cetak_pq_pdo_operasional/$1/$2/$3/$4';

// register pdp transfer

$route['laporan_pdp_transfer'] 																= 'laporan_pdp/transfer';
$route['laporan_pdp_transfer/cetak/(:any)/(:any)/(:any)/(:any)'] 							= 'laporan_pdp/cetak_register_pdp_transfer/$1/$2/$3/$4';

// Cetak_real_proyek_rinci
$route['laporan-realisasi-rinci-pdo'] 														= 'RealProyekRinciController/cetak_real_proyek_pdo_rinci';
$route['laporan-realisasi-rinci-spj'] 														= 'RealProyekRinciController/cetak_real_proyek_spj_rinci';
$route['laporan-realisasi-rinci-rap'] 														= 'RealProyekRinciController/cetak_RAP';

$route['laporan-realisasi-proyek'] 															= 'laporan_pq/lap_realisasi_proyek';





// jurnal
$route['cetak-jurnal-umum'] 																= 'jurnal/cetak_jurnal';
$route['cetak-jurnal-umum/cetak_jurnal_umum/(:any)/(:any)/(:any)/(:any)'] 					= 'jurnal/cetak_jurnal_umum/$1/$2/$3/$4';
$route['cetak-buku-besar'] 																	= 'jurnal/cetak_buku_besar';
$route['cetak-buku-besar/cetak_buku_besar/(:any)/(:any)/(:any)/(:any)'] 					= 'jurnal/cetak_bb/$1/$2/$3/$4';





// sah pq
$route['bod/view/(:any)'] 						= 'bod/view_pq/$1';







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