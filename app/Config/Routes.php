<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/Produk','Produk::index');

$routes->get('/produk/tampil', 'Produk::tampil_produk');

$routes->post('/produk/simpan', 'Produk::simpan_produk');

$routes->delete('/produk/delete/(:num)', 'Produk::hapus_produk/$1');

$routes->get('/produk/edit/(:num)', 'Produk::edit_produk/$1');

$routes->post('/produk/updateProduk', 'Produk::updateProduk'); 



$routes->get('/Pelanggan','Pelanggan::index');

$routes->get('/pelanggan/tampil', 'Pelanggan::tampil_pelanggan');

$routes->post('/pelanggan/simpan', 'Pelanggan::simpan_pelanggan');

$routes->post('pelanggan/delete/(:num)', 'Pelanggan::hapus_pelanggan/$1');

$routes->get('/pelanggan/edit/(:num)', 'Pelanggan::edit_pelanggan/$1');

$routes->post('/pelanggan/updatePelanggan', 'Pelanggan::updatePelanggan'); 