<?php

use Illuminate\Support\Facades\Route;

//use App\Http\Controllers\RoleController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\DocumentationController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\ExerciseController;


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

// Route::get('/pdf_show', function () {
// 	return view('pdf_template.plans_detail_pdf');
// });

//Auth Routes
Auth::routes();

//Register Controller
Route::get('/register', [RegisterController::class, 'show_form_register'])->name('show_register');
Route::post('/register', [RegisterController::class, 'create'])->name('register');
Route::get('/verify', [RegisterController::class, 'verifyUser'])->name('verify_user');

//Reset Password Controller
Route::get('/reset', [ResetPasswordController::class, 'show_reset_form'])->name('show_reset_form');
Route::post('/reset', [ResetPasswordController::class, 'reset_password'])->name('reset_password');

//Login Controller
Route::get('/logout', [LoginController::class, 'logout']);

//Roles and permissions controller
Route::middleware(['auth'])->group(function () {
	Route::resource('roles', RoleController::class);
	Route::resource('permissions', PermissionController::class);
});

//Documentation Controller
Route::middleware(['auth'])->group(function () {
	Route::resource('docs', DocumentationController::class);
	Route::post('/docs/upload_image', [DocumentationController::class, 'image_upload'])->name('docs.upload_image');
	Route::get('/docs/coach_docs', [DocumentationController::class, 'coach_docs'])->name('docs.coach_docs');
	Route::get('/docs/coachee_docs', [DocumentationController::class, 'coachee_docs'])->name('docs.coachee_docs');
	Route::get('/documentation', [DocumentationController::class, 'documentation_view'])->name('documentation');
	Route::get('/documentation/{documentation:category}', [DocumentationController::class, 'documentation_view'])->name('documentation.view');
});

//Class Controller
Route::middleware(['auth'])->group(function () {
	Route::resource('class', ClassController::class);
	Route::get('/ajaxCoachee', [ClassController::class, 'ajaxClass'])->name('coachee.search');
	Route::post('/class/remove', [ClassController::class, 'remove_client'])->name('class.remove_client');
});

//Profile Controller
Route::middleware(['auth'])->group(function () {
	Route::get('/{id}/profil', [ProfileController::class, 'profil'])->name('profil');
	Route::post('/{id}/change-password', [ProfileController::class, 'simpan_password'])->name('simpan_password');
	Route::post('/{id}/update_profil', [ProfileController::class, 'update_profil'])->name('update_profil');
	Route::post('/{id}/update_background', [ProfileController::class, 'update_background'])->name('update_background');
	Route::post('/{id}/store', [ProfileController::class, 'store_data'])->name('store_data');
});

//User Controller
Route::middleware(['auth'])->group(function () {
	Route::post('/suspend', [UserController::class, 'suspend_user'])->name('suspend_user');
	Route::post('/unsuspend', [UserController::class, 'unsuspend_user'])->name('unsuspend_user');
	Route::resource('users', UserController::class);
});

//Home controller
Route::middleware(['auth'])->group(function () {
	Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
	Route::get('/home/show_agendas_list', [HomeController::class, 'show_agendas_data'])->name('home.show_agendas_list');
	Route::get('/home/show_upcoming_individual_events', [HomeController::class, 'show_upcoming_individual_events'])->name('home.show_upcoming_individual_events');
	Route::get('/home/show_upcoming_group_events', [HomeController::class, 'show_upcoming_group_events'])->name('home.show_upcoming_group_events');
	Route::get('/home/show_agenda_individual_events', [HomeController::class, 'show_agenda_individual_events'])->name('home.show_agenda_individual_events');
	Route::get('/home/show_agenda_group_events', [HomeController::class, 'show_agenda_group_events'])->name('home.show_agenda_group_events');
	Route::post('/home/{id}/store', [HomeController::class, 'store_data'])->name('home.store_data');
});

//Plan Controller
Route::middleware(['auth'])->group(function () {
	Route::resource('plans', PlanController::class);
	Route::get('/plans/{id}/pdf', [PlanController::class, 'plan_detail_to_pdf'])->name('plans.detail_to_pdf');
	Route::get('/ajaxClients', [PlanController::class, 'ajaxClients'])->name('clients.search');
	Route::get('/ajaxInsertUsers', [PlanController::class, 'ajaxInsertUsers'])->name('users.search');
	Route::get('/show_group_list', [PlanController::class, 'show_group_list'])->name('plans.show_group');
});

//Agendas Controller
Route::middleware(['auth'])->group(function () {
	Route::get('/agendas/sessions_individual', [AgendaController::class, 'show_individual_sessions'])->name('agendas.sessions_individual');
	Route::get('/agendas/sessions_group', [AgendaController::class, 'show_group_sessions'])->name('agendas.sessions_group');
	Route::resource('agendas', AgendaController::class)->except([
		'update', 'edit'
	]);
	Route::post('/agendas/{id}/update', [AgendaController::class, 'update'])->name('agendas.update');
	Route::get('/agendas/{id}/edit', [AgendaController::class, 'edit'])->name('agendas.edit');
	Route::post('/agendas/{id}/agenda_detail_update', [AgendaController::class, 'agenda_detail_update'])->name('agendas.agenda_detail_update');
	Route::post('/agendas/{id}/add_feedback_from_coachee', [AgendaController::class, 'add_feedback_from_coachee'])->name('add_feedback_from_coachee');
	Route::get('/agendas/{id}/feedback_download', [AgendaController::class, 'feedback_download'])->name('agendas.feedback_download');
	Route::get('/agendas/{id}/note_download', [AgendaController::class, 'note_download'])->name('agendas.note_download');
	Route::get('/ajaxPlans', [AgendaController::class, 'ajaxPlans'])->name('plans.search');
});

//Client controller
Route::middleware(['auth'])->group(function () {
	Route::resource('clients', ClientController::class)->except([
		'store'
	]);;
	Route::get('/show_coach_list', [ClientController::class, 'show_coach_list'])->name('show_coach_list');
	Route::get('/show_coachee_list', [ClientController::class, 'show_coachee_list'])->name('show_coachee_list');
	Route::get('/show_admin_list', [ClientController::class, 'show_admin_list'])->name('show_admin_list');
	Route::get('/show_trainer_list', [ClientController::class, 'show_trainer_list'])->name('show_trainer_list');
	Route::get('/show_mentor_list', [ClientController::class, 'show_mentor_list'])->name('show_mentor_list');
	Route::post('/clients/{client}/update', [ClientController::class, 'store'])->name('clients.store');
	Route::get('/clients/{client}/show_upcoming', [ClientController::class, 'show_upcoming_list'])->name('clients.show_upcoming');
	Route::get('/clients/{client}/show_agendas', [ClientController::class, 'show_agendas_list'])->name('clients.show_agendas');
	Route::get('/clients/{client}/show_sessions', [ClientController::class, 'show_sessions_list'])->name('clients.show_sessions');
	Route::get('/clients/{client}/show_plans', [ClientController::class, 'show_plans_list'])->name('clients.show_plans');
	Route::get('/clients/{client}/show_notes', [ClientController::class, 'show_notes_list'])->name('clients.show_notes');
	Route::get('/clients/{client}/show_feedbacks', [ClientController::class, 'show_feedbacks_list'])->name('clients.show_feedbacks');
	Route::get('clients/{id}/show_detail_feedbacks', [ClientController::class, 'show_detail_feedbacks'])->name('clients.show_detail_feedbacks');
	Route::get('clients/{id}/show_detail_notes', [ClientController::class, 'show_detail_notes'])->name('clients.show_detail_notes');
	Route::get('/get_client_data/{id}', [ClientController::class, 'get_client_data'])->name('get_client_data');
	Route::get('/groups', [ClientController::class, 'show_group_list'])->name('group.index');
	Route::get('/groups/{id}', [ClientController::class, 'show_group_detail'])->name('group.show');
	Route::get('/coachee_pdf', [ClientController::class, 'coachee_pdf_download'])->name('coachee_pdf');
	Route::get('/coach_pdf', [ClientController::class, 'coach_pdf_download'])->name('coach_pdf');
});

//Topic Controller
Route::middleware(['auth'])->group(function () {
	Route::resource('topic', TopicController::class);
});

//Exercise Controller
Route::middleware(['auth'])->group(function () {
	Route::resource('exercise', ExerciseController::class);
});
