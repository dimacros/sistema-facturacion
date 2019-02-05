<?php
Route::view('home', 'admin.home')->name('home');
/* DataTable */
Route::get('productos/data', 'ProductController@data')->name('products.data');
Route::get('clientes/data', 'CustomerController@data')->name('customers.data');
Route::get('mis-facturas/data', 'MyInvoiceController@data')->name('my-invoices.data');
/* Resources */
Route::resource('tiendas', 'StoreController')->names('stores')->except(['create', 'show', 'edit']);
Route::resource('usuarios', 'UserController')->names('users')->except(['show', 'edit']);
Route::resource('productos', 'ProductController')->names('products')->except(['show', 'edit']);
Route::resource('clientes', 'CustomerController')->names('customers');
Route::resource('mis-facturas', 'MyInvoiceController')->names('my-invoices');