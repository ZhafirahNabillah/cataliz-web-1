<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
//use App\Http\Controllers\RoleController;
//use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\PlanController;

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

/* Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware'=>['auth','admin']], function(){
		Route::get('/', function () {
			//return view('welcome');
			return redirect('/dashboard');
		});
		Route::get('/dashboard', function() {
			return view('admin.dashboard');
		});
		
		Route::get('client', function() {
			return view('clients.index');
		});
		
		
		
});

	Route::get('clients', [App\Http\Controllers\ClientController::class, 'index'])->name('clients'); */
	

  
Auth::routes();
  
Route::get('/home', [HomeController::class, 'index'])->name('home');
//Route::get('clients/list', [ClientController::class, 'getClients'])->name('clients.list');  
Route::group(['middleware' => ['auth']], function() {
	Route::get('/', function () {
		return redirect('/home');
	});
    //Route::resource('roles', RoleController::class);
    //Route::resource('users', UserController::class);
    Route::resource('clients', ClientController::class);
    Route::resource('agendas', AgendaController::class);
    Route::resource('plans', PlanController::class);
    Route::get('/ajaxClients',[ PlanController::class, 'ajaxClients'])->name('clients.search');
	
	//Route::get('clients/all', [ClientController::class, 'getAll'])->name('clients.all');
});