# laravel
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

Route::get('/welcome', function () {
   	return view('index');
});


//Route::get('/login', ["uses"=>"LoginController@index"]);
Route::get('/login', 'LoginController@index')->name('login.index');
Route::post('/login', 'LoginController@valid');

Route::get('/registration', 'RegistrationController@index')->name('registration.index');
Route::post('/registration', 'RegistrationController@valid');

Route::get('/home', 'HomeController@index')->name('home.index');
Route::get('/details/{pname}', 'HomeController@details');
Route::get('/prodctList', 'HomeController@show');

/*Route::get('/add/sdgsd/sdfsdf', 'HomeController@add')->name('home.add');*/
Route::get('/add', ["as"=>"home.add","uses"=>"HomeController@add"]);
Route::post('/add', 'HomeController@create');

Route::get('/edit/{pname}', 'HomeController@edit');
Route::post('/edit/{pname}', 'HomeController@update');

Route::get('/delete/{pname}', 'HomeController@delete');
Route::post('/delete/{pname}', 'HomeController@destroy');

Route::get('/logout', 'LogoutController@index');
