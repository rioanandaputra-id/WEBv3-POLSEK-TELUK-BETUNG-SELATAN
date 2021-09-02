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
