<?php

use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\PhoneBookController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('phonebook.index');
});

Route::controller(PhoneBookController::class)->group(function () {
    Route::get('/phonebook/index', 'index');
    Route::post('/phonebook/store', 'store');
    Route::patch('/phonebook/update/{phonebook}', 'update');
    Route::delete('/phonebook/delete/{phonebook}', 'destroy');
});

