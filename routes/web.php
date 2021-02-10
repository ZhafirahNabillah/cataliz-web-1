<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
//use App\Http\Controllers\RoleController;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

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
Route::get('/', function() {
	return redirect('login');
});

//Authenticare route
Auth::routes();
Route::get('/register/coach', [RegisterController::class, 'show_form_coach'])->name('show_register.coach');
Route::get('/register/coachee', [RegisterController::class, 'show_form_coachee'])->name('show_register.coachee');

Route::post('/register/coach', [RegisterController::class, 'create_coach'])->name('register.coach');
Route::post('/register/coachee', [RegisterController::class, 'create_coachee'])->name('register.coachee');
Route::get('/logout', [LoginController::class, 'logout']);

//Middleware group for coachee page
Route::group(['middleware' => ['auth','role:coachee']], function (){
	Route::get('/coachee/dashboard', function() {
		return 'Dashboard Coachee';
	})->name('dashboard.coachee');
});

//Middleware group for admin page
Route::group(['middleware' => ['auth','role:admin']], function (){
	Route::get('/admin/dashboard', function() {
		return 'Dashboard Admin';
	})->name('dashboard.admin');
});

//Middleware group for coach page
Route::group(['middleware' => ['auth','role:coach']], function () {
	Route::get('/coach/dashboard', [HomeController::class, 'index'])->name('dashboard.coach');
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

});
