<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
//use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\Auth\ResetPasswordController;

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

Route::get('/home', function () {
	return redirect('login');
});

//Authenticate route
Auth::routes();
Route::get('/register', [RegisterController::class, 'show_form_register'])->name('show_register');
Route::post('/register', [RegisterController::class, 'create'])->name('register');
Route::get('/logout', [LoginController::class, 'logout']);
Route::get('/reset', [ResetPasswordController::class, 'show_reset_form'])->name('show_reset_form');
Route::post('/reset', [ResetPasswordController::class, 'reset_password'])->name('reset_password');

//Middleware group for admin page
Route::group(['middleware' => ['auth']], function () {
	Route::resource('roles', RoleController::class);
	Route::resource('permissions', PermissionController::class);
	Route::resource('users', UserController::class);
	Route::resource('class', ClassController::class);
	Route::get('/show_coach_list', [ClientController::class, 'show_coach_list'])->name('show_coach_list');
	Route::get('/show_coachee_list', [ClientController::class, 'show_coachee_list'])->name('show_coachee_list');
	Route::get('/show_admin_list', [ClientController::class, 'show_admin_list'])->name('show_admin_list');
	Route::post('/suspend', [UserController::class, 'suspend_user'])->name('suspend_user');
	Route::post('/unsuspend', [UserController::class, 'unsuspend_user'])->name('unsuspend_user');
	Route::get('/ajaxCoachs', [ClassController::class, 'ajaxClass'])->name('coachs.search');
});

//Middleware group for coach page
Route::group(['middleware' => ['auth']], function () {
	Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
	Route::get('/home/show_agendas_list', [HomeController::class, 'show_agendas_data'])->name('home.show_agendas_list');
	Route::get('/home/show_upcoming_list', [HomeController::class, 'show_upcoming_data'])->name('home.show_upcoming_list');
	Route::post('/home/{id}/store', [HomeController::class, 'store_data'])->name('home.store_data');

	//Route::resource('roles', RoleController::class);
	Route::get('/{id}/profil', [ProfileController::class, 'profil'])->name('profil');
	Route::post('/{id}/change-password', [ProfileController::class, 'simpan_password'])->name('simpan_password');
	Route::post('/{id}/update_profil', [ProfileController::class, 'update_profil'])->name('update_profil');
	Route::post('/{id}/update_background', [ProfileController::class, 'update_background'])->name('update_background');
	Route::post('/{id}/store', [ProfileController::class, 'store_data'])->name('store_data');

	Route::resource('plans', PlanController::class);
	Route::get('/ajaxClients', [PlanController::class, 'ajaxClients'])->name('clients.search');

	Route::resource('agendas', AgendaController::class);
	Route::post('/agendas/{id}/update', [AgendaController::class, 'update'])->name('agendas.update');
	Route::get('/agendas/{id}/edit', [AgendaController::class, 'edit'])->name('agendas.edit');
	Route::get('/ajaxPlans', [AgendaController::class, 'ajaxPlans'])->name('plans.search');
	Route::post('/agendas/{id}/agenda_detail_update', [AgendaController::class, 'agenda_detail_update'])->name('agendas.agenda_detail_update');
	Route::post('/agendas/{id}/add_feedback_from_coachee', [AgendaController::class, 'add_feedback_from_coachee'])->name('add_feedback_from_coachee');
	Route::get('/agendas/{id}/feedback_download', [AgendaController::class, 'feedback_download'])->name('agendas.feedback_download');
	Route::get('/agendas/{id}/note_download', [AgendaController::class, 'note_download'])->name('agendas.note_download');

	Route::resource('clients', ClientController::class);
	Route::post('/clients/{client}/update', [ClientController::class, 'store'])->name('clients.store');
	Route::get('/clients/{client}/show_sessions', [ClientController::class, 'show_sessions_data'])->name('clients.show_sessions');
	Route::get('/clients/{client}/show_plans', [ClientController::class, 'show_plans_data'])->name('clients.show_plans');
	Route::get('/clients/{client}/show_feedbacks', [ClientController::class, 'show_feedbacks_data'])->name('clients.show_feedbacks');
	Route::get('/clients/{client}/show_notes', [ClientController::class, 'show_notes_data'])->name('clients.show_notes');
	Route::get('/clients/{client}/show_agendas_list', [ClientController::class, 'show_agendas_data'])->name('clients.show_agendas_list');
	Route::get('clients/{id}/show_detail_feedbacks', [ClientController::class, 'show_detail_feedbacks'])->name('clients.show_detail_feedbacks');
	Route::get('clients/{id}/show_detail_notes', [ClientController::class, 'show_detail_notes'])->name('clients.show_detail_notes');

	Route::post('/class/{class}/ubah_status', [ClassController::class, 'ubah_status'])->name('class.ubah_status');
});
