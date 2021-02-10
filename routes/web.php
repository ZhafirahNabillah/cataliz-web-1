<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
//use App\Http\Controllers\RoleController;
use App\Http\Controllers\CoachController;
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
Route::group(['middleware' => ['auth']], function () {
	Route::get('/', function () {
		return redirect('/home');
	});
	Route::get('/home/show_agendas_list', [HomeController::class, 'show_agendas_data'])->name('home.show_agendas_list');
	//Route::resource('roles', RoleController::class);
	Route::resource('coachs', CoachController::class);
	Route::get('/coachs/{id}/profil', [CoachController::class, 'profil'])->name('coachs.profil');
	Route::post('/coachs/{id}/change-password', [CoachController::class, 'simpan_password'])->name('coachs.simpan_password');
	Route::post('/coachs/{id}/update_profil', [CoachController::class, 'update_profil'])->name('coachs.update_profil');
	Route::post('/coachs/{id}/update_background', [CoachController::class, 'update_background'])->name('coachs.update_background');

	Route::resource('clients', ClientController::class);
	Route::resource('agendas', AgendaController::class);
	Route::resource('plans', PlanController::class);
	Route::get('/ajaxClients', [PlanController::class, 'ajaxClients'])->name('clients.search');
	Route::post('/agendas/{id}/update', [AgendaController::class, 'update'])->name('agendas.update');
	Route::get('/agendas/{id}/edit', [AgendaController::class, 'edit'])->name('agendas.edit');

	Route::post('/agendas/{id}/agenda_detail_update', [AgendaController::class, 'agenda_detail_update'])->name('agendas.agenda_detail_update');
	Route::get('/agendas/{id}/feedback_download', [AgendaController::class, 'feedback_download'])->name('agendas.feedback_download');
	Route::get('/agendas/{id}/note_download', [AgendaController::class, 'note_download'])->name('agendas.note_download');
	Route::get('/clients/{client}/show_agendas', [ClientController::class, 'show_sessions_data'])->name('clients.show_agendas');
	Route::get('/clients/{client}/show_plans', [ClientController::class, 'show_plans_data'])->name('clients.show_plans');
	Route::get('/clients/{client}/show_agendas_list', [ClientController::class, 'show_agendas_data'])->name('clients.show_agendas_list');

	//Route::get('clients/all', [ClientController::class, 'getAll'])->name('clients.all');
});
