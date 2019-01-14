<?php
Route::view('home', 'admin.home')->name('home');
Route::resource('tiendas', 'StoreController')->names('stores')->except(['create', 'show', 'edit']);
Route::resource('usuarios', 'UserController')->names('users')->except(['show', 'edit']);
Route::resource('productos', 'ProductController')->names('products')->except(['show', 'edit']);
Route::resource('clientes', 'CustomerController')->names('customers');
Route::resource('compras', 'PurchaseController')->names('purchases');