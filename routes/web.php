<?php

use Peru\Http\ContextClient;
use Peru\Sunat\{HtmlParser, Ruc, RucParser};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false, 'reset' => true, 'verify' => true]);
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/ruc/{ruc}', function($ruc) {

    $rucFinder = new Ruc(new ContextClient(), new RucParser(new HtmlParser()));
    $company = $rucFinder->get($ruc);

    if (! $company) {
        return response()->json(['message' => 'Not found'], 404);
    }

    return response()->json($company);

})->middleware('auth');
