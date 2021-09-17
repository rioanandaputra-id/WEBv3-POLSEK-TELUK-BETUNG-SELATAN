<?php
defined('BASEPATH') or exit('No direct script access allowed');
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['admin/informasi/berita'] = 'admin/berita';
$route['admin/informasi/berita/tambah'] = 'admin/berita_add';
$route['admin/informasi/berita/ubah/(:num)'] = 'admin/berita_edit/$1';

$route['admin/informasi/bhabin'] = 'admin/bhabin';
$route['admin/informasi/bhabin/tambah'] = 'admin/bhabin_add';
$route['admin/informasi/bhabin/ubah/(:num)'] = 'admin/bhabin_edit/$1';

$route['admin/informasi/nomor'] = 'admin/nomor';

$route['admin/informasi/barang'] = 'admin/barang';
$route['admin/informasi/barang/tambah'] = 'admin/barang_add';
$route['admin/informasi/barang/ubah/(:num)'] = 'admin/barang_edit/$1';

$route['admin/informasi/orang'] = 'admin/orang';
$route['admin/informasi/orang/tambah'] = 'admin/orang_add';
$route['admin/informasi/orang/ubah/(:num)'] = 'admin/orang_edit/$1';

$route['admin/informasi/tahanan'] = 'admin/tahanan';
$route['admin/informasi/tahanan/tambah'] = 'admin/tahanan_add';
$route['admin/informasi/tahanan/ubah/(:num)'] = 'admin/tahanan_edit/$1';

$route['admin/informasi/buronan'] = 'admin/buronan';
$route['admin/informasi/buronan/tambah'] = 'admin/buronan_add';
$route['admin/informasi/buronan/ubah/(:num)'] = 'admin/buronan_edit/$1';

$route['admin/pengaduan/umum'] = 'admin/pengaduan/umum';
$route['admin/pengaduan/umum/respon/(:num)'] = 'admin/pengaduan_respon/$1';

$route['admin/pengaduan/covid'] = 'admin/pengaduan/covid-19';
$route['admin/pengaduan/covid/respon/(:num)'] = 'admin/pengaduan_respon/$1';


$route['admin/laporan/tipec'] = 'admin/tipec';
$route['admin/laporan/tipec/detail/(:any)'] = 'admin/tipec_detail/$1';

$route['admin/laporan/tipeb'] = 'admin/tipeb';
$route['admin/laporan/tipeb/tambah'] = 'admin/tipeb_add';
$route['admin/laporan/tipeb/ubah/(:num)'] = 'admin/tipeb_edit/$1';
