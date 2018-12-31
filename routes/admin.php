<?php 

Route::resource('tiendas', 'StoreController')->except(['create', 'show', 'edit']);
Route::resource('usuarios', 'UserController')->except(['create', 'show', 'edit']);