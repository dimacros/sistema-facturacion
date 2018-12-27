<?php

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
Route::get('/test', function(){

    $service = new Peru\Sunat\Ruc();
    $service->setClient(new Peru\Http\ContextClient());
    $ruc = '10762119220';
    $company = $service->get($ruc);
    if ($company === false) {
        return $service->getError();
    }

    return $company;

});
