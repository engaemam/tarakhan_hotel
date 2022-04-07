<?php
use Illuminate\Support\Facades\Input;

use App\reservations;
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
    return view('index');
});
Route::get('/about', function () {
    return view('about');
});
Route::get('/accomodation', function () {
    return view('accomodation');
});
Route::get('/blog-single', function () {
    return view('blog-single');
});
Route::get('/blog', function () {
    return view('blog');
});
Route::get('/elements', function () {
    return view('elements');
});
Route::get('/gallery', function () {
    return view('gallery');
});
Route::get('/contact', function () {
    return view('contact');
});
Route::get('/reserve', function () {
    
    return view('res');
});
Route::get('/dialog', function () {
    
    return view('dialog');
});
Route::get('/restable', function () {
    
    return view('reserverooms');
});
Route::get('/mousa', function () {
    
    return view('mousa');
});
Route::get('/index', 'ReserveController@index');
Route::get('/create', 'ReserveController@make_res');
Route::get('/Rcreate', 'RoomsController@create');
Route::get('/vres', function (){
    return view('viewreserve');
});
Route::get('/vres/{id}', 'ReserveController@res_view');
Route::get('/res/edit/{id}','ReserveController@update_res');

Route::get('/edit/unpaid/{id}','ReserveController@update_notpaid');
Route::get('/unpaid/{id}', 'ReserveController@res_unpaid');
Route::get('/delete/{id}', 'ReserveController@destroy');
Route::get('/notpaid', function () {
    return view('notpaid');
});

Route::any('/search',function(){
    $q = Input::get ( 'search' );
    $user = reservations::where('a_name','LIKE','%'.$q.'%')->orWhere('phone','LIKE','%'.$q.'%')->get();
    if(count($user) > 0)
        return view('searchres')->withDetails($user)->withQuery ( $q );
        else return view ('searchres')->withMessage('No Details found. Try to search again !');
});
Route::any('/search/unpaid',function(){
    $q = Input::get ( 'search' );
    $user = reservations::where('a_name','LIKE','%'.$q.'%')->orWhere('phone','LIKE','%'.$q.'%')->where('paid','LIKE','0')->get();
    if(count($user) > 0)
        return view('searchres')->withDetails($user)->withQuery ( $q );
        else return view ('searchres')->withMessage('No Details found. Try to search again !');
});

Route::any('/availrooms',function(){
    
    $user = reservations::where('Active','LIKE','%'.'Reserved'.'%')->get();
    if(count($user) > 0)
        return view('roomsavailable')->withDetails($user);
        else return view ('roomsavailable')->withMessage('No Details found. Try to search again !');
});
Route::get('/calc', function () {
    
    return view('Calculations');
});
Route::get('/anualcalc', function () {
    
    return view('AnualCalc');
});