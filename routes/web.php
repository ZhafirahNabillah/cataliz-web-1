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
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;

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
	return redirect('login');
});

//Authenticate route
Auth::routes();
Route::get('/register', [RegisterController::class, 'show_form_register'])->name('show_register');
Route::post('/register', [RegisterController::class, 'create'])->name('register');
Route::get('/logout', [LoginController::class, 'logout']);

//Middleware group for admin page
Route::group(['middleware' => ['auth']], function () {

	Route::resource('roles', RoleController::class);
	Route::resource('permissions', PermissionController::class);
	Route::resource('users', UserController::class);
});

//Middleware group for coach page
Route::group(['middleware' => ['auth']], function () {
	Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
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
	Route::get('/ajaxPlans', [AgendaController::class, 'ajaxPlans'])->name('plans.search');

	Route::post('/agendas/{id}/agenda_detail_update', [AgendaController::class, 'agenda_detail_update'])->name('agendas.agenda_detail_update');
	Route::get('/agendas/{id}/feedback_download', [AgendaController::class, 'feedback_download'])->name('agendas.feedback_download');
	Route::get('/agendas/{id}/note_download', [AgendaController::class, 'note_download'])->name('agendas.note_download');
	Route::get('/clients/{client}/show_sessions', [ClientController::class, 'show_sessions_data'])->name('clients.show_sessions');
	Route::get('/clients/{client}/show_plans', [ClientController::class, 'show_plans_data'])->name('clients.show_plans');
	Route::get('/clients/{client}/show_feedbacks', [ClientController::class, 'show_feedbacks_data'])->name('clients.show_feedbacks');
	Route::get('/clients/{client}/show_notes', [ClientController::class, 'show_notes_data'])->name('clients.show_notes');
	Route::get('/clients/{client}/show_agendas_list', [ClientController::class, 'show_agendas_data'])->name('clients.show_agendas_list');

	Route::get('clients/{id}/show_detail_feedbacks', [ClientController::class, 'show_detail_feedbacks'])->name('clients.show_detail_feedbacks');
	Route::get('clients/{id}/show_detail_notes', [ClientController::class, 'show_detail_notes'])->name('clients.show_detail_notes');
});
