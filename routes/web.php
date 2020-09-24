<?php

use Illuminate\Support\Facades\Route;

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


Route::get('/home', 'HomeController@index')->name('home');

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

// Route::get('/', function () {
//     if (Auth::check()) {
//         return redirect()->route('home');
//     } else {
//         return redirect()->route('welcome');
//     }
// });


Route::get('/', function () {
    return view('welcome');
    return view('welcome');
});


Auth::routes();

Route::delete('/cart', 'CartController@clear')->name('cart.clear');

Route::resources([
    'subjects' => 'SubjectController',
    'units' => 'UnitController',
    'tickets' => 'TicketController',
    'cart' => 'CartController',
    'users' => 'UserController',
    'categories' => 'CategoryController'
]);



