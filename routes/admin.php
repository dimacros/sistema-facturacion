<?php

Route::resource('tiendas', 'StoreController')->names('stores')->except(['create', 'show', 'edit']);
Route::resource('usuarios', 'UserController')->names('users')->except(['show', 'edit']);