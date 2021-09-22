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
use App\Http\Controllers\SubTopicController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\TrainingFeedbackController;
use App\Http\Controllers\TrainingMeetingController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\GraduateController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\LogActivityController;
use App\Http\Controllers\BookingController;


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


// Route::get('/email_show', function () {
// 	return view('email_template.scheduled_session_mail');
// });

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

Route::get('/graduates/{id}/certificate', [GraduateController::class, 'create_certificate'])->name('graduates.certificate');

//Booking controller
Route::get('/booking/create', [BookingController::class, 'create'])->name('booking.create');
Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');
Route::get('/booking/email_successbooking', [BookingController::class, 'seeEmailSuccess'])->name('booking.email_successbooking');
Route::get('/booking/email_verifbooking', [BookingController::class, 'seeEmailVerif'])->name('booking.email_verifbooking');
// Route::get('/booking/payment', [BookingController::class, 'seePayment'])->name('booking.payment');
// Route::get('/booking/search', [BookingController::class, 'search'])->name('booking.search');
Route::get('/{id}/booking/payment', [BookingController::class, 'payment'])->name('booking.payment');
Route::put('/{id}/booking/update', [BookingController::class, 'update'])->name('booking.update');
Route::get('/booking/verif', [BookingController::class, 'verif'])->name('booking.verif');

Route::middleware(['auth'])->group(function () {
	Route::get('/booking/index', [BookingController::class, 'index'])->name('booking.index');
	//Route::resource('booking', BookingController::class);
});

//Roles and permissions controller
Route::middleware(['auth'])->group(function () {
	Route::resource('roles', RoleController::class);
	Route::resource('permissions', PermissionController::class);
});

//Documentation Controller
Route::middleware(['auth'])->group(function () {
	Route::post('/docs/upload_image', [DocumentationController::class, 'image_upload'])->name('docs.upload_image');
	Route::get('/docs/coach_docs', [DocumentationController::class, 'coach_docs'])->name('docs.coach_docs');
	Route::get('/docs/coachee_docs', [DocumentationController::class, 'coachee_docs'])->name('docs.coachee_docs');
	Route::get('/docs/trainer_docs', [DocumentationController::class, 'trainer_docs'])->name('docs.trainer_docs');
	Route::get('/docs/mentor_docs', [DocumentationController::class, 'mentor_docs'])->name('docs.mentor_docs');
	Route::get('/docs/coachmentors_docs', [DocumentationController::class, 'coachmentors_docs'])->name('docs.coachmentors_docs');
	Route::get('/docs/manager_docs', [DocumentationController::class, 'manager_docs'])->name('docs.manager_docs');
	Route::resource('docs', DocumentationController::class);
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
	Route::get('/ajaxSkillSearch', [ProfileController::class, 'skill_search'])->name('skill.search');
	Route::get('/{id}/profil', [ProfileController::class, 'profil'])->name('profil');
	Route::get('/{id}/profil/detail', [ProfileController::class, 'profil_detail'])->name('profil.detail');
	Route::post('/change-password', [ProfileController::class, 'simpan_password'])->name('simpan_password');
	Route::post('/{id}/update_profil', [ProfileController::class, 'update_profil'])->name('update_profil');
	Route::post('/{id}/update_background', [ProfileController::class, 'update_background'])->name('update_background');
	Route::post('/{id}/store', [ProfileController::class, 'store_data'])->name('store_data');
	Route::post('/{id}/update_full_profil', [ProfileController::class, 'update_full_profil'])->name('update_full_profil');
	Route::post('/{id}/detail/save_categories', [ProfileController::class, 'save_categories'])->name('profile.save_categories');
	Route::post('/{id}/detail/save_skills', [ProfileController::class, 'save_skills'])->name('profile.save_skills');
	Route::post('/{id}/detail/save_educations', [ProfileController::class, 'save_educations'])->name('profile.save_educations');
	Route::post('/{id}/detail/save_employments', [ProfileController::class, 'save_employments'])->name('profile.save_employments');
	Route::post('/{id}/detail/save_languages', [ProfileController::class, 'save_languages'])->name('profile.save_languages');
	Route::post('/{id}/detail/save_overview', [ProfileController::class, 'save_overview'])->name('profile.save_overview');
	Route::post('/{id}/detail/save_address', [ProfileController::class, 'save_address'])->name('profile.save_address');
	Route::get('profile/{id}/review', [ProfileController::class, 'profile_review'])->name('profile.review');
});

//Log Activity Controller
Route::middleware(['auth'])->group(function () {
	Route::resource('log_activity', LogActivityController::class);
	Route::get('/activity', [LogActivityController::class, 'index'])->name('activity.index');
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
	Route::get('/home/show_topics', [HomeController::class, 'show_topics'])->name('home.show_topics');
	Route::post('/home/{id}/store', [HomeController::class, 'store_data'])->name('home.store_data');
	Route::get('/home/calendar', [HomeController::class, 'load_calendar_data'])->name('home.get_calendar_data');
	Route::get('/home/get_date_event', [HomeController::class, 'get_date_event'])->name('home.get_date_event');
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
	Route::get('/show_coachmentors_list', [ClientController::class, 'show_coachmentors_list'])->name('show_coachmentors_list');
	Route::get('/show_manager_list', [ClientController::class, 'show_manager_list'])->name('show_manager_list');
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
	Route::get('/show_deleted_admin_list', [ClientController::class, 'show_deleted_admin_list'])->name('show_deleted_admin_list');
	Route::get('/show_deleted_coach_list', [ClientController::class, 'show_deleted_coach_list'])->name('show_deleted_coach_list');
	Route::get('/show_deleted_coachee_list', [ClientController::class, 'show_deleted_coachee_list'])->name('show_deleted_coachee_list');
	Route::get('/show_deleted_trainer_list', [ClientController::class, 'show_deleted_trainer_list'])->name('show_deleted_trainer_list');
	Route::get('/show_deleted_mentor_list', [ClientController::class, 'show_deleted_mentor_list'])->name('show_deleted_mentor_list');
	Route::get('/restore_user/{id}', [ClientController::class, 'restore_user'])->name('restore_user');
	Route::get('/restore_all_user', [ClientController::class, 'restore_all_user'])->name('restore_all_user');
	Route::post('/delete_user_permanently/{id}', [ClientController::class, 'delete_user_permanently'])->name('delete_user_permanently');
	Route::post('/delete_all_permanently', [ClientController::class, 'delete_all_permanently'])->name('delete_all_permanently');
});

//Topic Controller
Route::middleware(['auth', 'HtmlSanitizer'])->group(function () {
	Route::resource('topic', TopicController::class);
	Route::get('/topic/{topic}/download', [TopicController::class, 'topic_pdf_download'])->name('topic.download');
	Route::get('/topic_search', [TopicController::class, 'topic_search'])->name('topic.search');
});

//Exercise Controller
Route::middleware(['auth'])->group(function () {
	Route::resource('exercise', ExerciseController::class);
	Route::get('/exercise/{exam}/start', [ExerciseController::class, 'start_exam'])->name('exercise.start');
	Route::post('/exercise/save_answer', [ExerciseController::class, 'save_answer'])->name('exercise.save_answer');
	Route::get('/exercise/{id}/continue', [ExerciseController::class, 'continue_exam'])->name('exercise.continue');
	Route::get('/exercise/{exam_result}/submit_all', [ExerciseController::class, 'submit_all'])->name('exercise.submit_all');
});

//Question Controller
Route::middleware(['auth', 'HtmlSanitizer'])->group(function () {
	Route::resource('question', QuestionController::class);
	Route::get('/add_new_question/{id}', [QuestionController::class, 'add_new_question'])->name('question.add_new');
	Route::post('/add_new_question/{exam}/new', [QuestionController::class, 'store_new_question'])->name('question.store_new');
});

//Category Controller
Route::middleware(['auth'])->group(function () {
	Route::resource('category', CategoryController::class);
	Route::get('/category_search', [CategoryController::class, 'category_search'])->name('category.search');
	Route::get('/sub_category_search', [CategoryController::class, 'sub_category_search'])->name('sub_category.search');
});

//User Controller
Route::middleware(['auth'])->group(function () {
	Route::resource('users', UserController::class);
});

//Sub-topic Controller
Route::middleware(['auth'])->group(function () {
	Route::resource('sub-topic', SubTopicController::class);
});

//Lesson Controller
Route::middleware(['auth'])->group(function () {
	Route::resource('lesson', LessonController::class);
	// Route::post('/lesson/video_upload', [LessonController::class, 'lesson_video_upload'])->name('lesson.video_upload');
	Route::post('/chunk_upload', [LessonController::class, 'lesson_chunk_upload'])->name('lesson.chunk_upload');
	Route::post('/add_to_lesson_history', [LessonController::class, 'add_to_lesson_history'])->name('lesson.add_to_lesson_history');
});

// Result Controller
Route::middleware(['auth'])->group(function () {
	Route::resource('result', ResultController::class);
});

// Training Feedback Controller
Route::middleware(['auth'])->group(function () {
	Route::resource('training_feedback', TrainingFeedbackController::class);
});

// Training Feedback Controller
Route::middleware(['auth'])->group(function () {
	Route::resource('training_meeting', TrainingMeetingController::class);
});

// Report Controller
Route::middleware(['auth'])->group(function () {
	Route::resource('report', ReportController::class);
	Route::get('/report_group', [ReportController::class, 'create_group'])->name('report.create_group');
	Route::post('/report_group/store_group', [ReportController::class, 'store_group'])->name('report.store_group');
	Route::get('/ajaxGroup', [ReportController::class, 'search_group'])->name('report.search_group');
	Route::get('/report_group/show_group_data', [ReportController::class, 'show_group_datatable'])->name('report.show_group_table');
	Route::get('/report_group/show_group/{id}', [ReportController::class, 'show_group'])->name('report.show_group');
	Route::get('/group/{group_id}', [ReportController::class, 'show_group_count'])->name('report.show_group_count');
});

// Alumni Controller
Route::middleware(['auth'])->group(function () {
	Route::resource('graduates', GraduateController::class);
	Route::post('/graduates/store_certificate', [GraduateController::class, 'store_certificate_data'])->name('graduates.store_certificate_data');
	Route::get('/load_graduates_data', [GraduateController::class, 'load_graduates_data'])->name('graduates.load_graduates_data');
	Route::get('/load_clients_data', [GraduateController::class, 'load_clients_data'])->name('graduates.search_clients');
});

//Program and batch Controller
Route::middleware(['auth'])->group(function () {
	Route::resource('program', ProgramController::class);
	Route::get('/{id}/get_batch', [ProgramController::class, 'get_batch'])->name('program.get_batch');
	Route::post('/program/store_certificate', [ProgramController::class, 'store_certificate'])->name('program.store_certificate');
	Route::post('/program/remove_certificate', [ProgramController::class, 'remove_certificate'])->name('program.remove_certificate');
	Route::resource('batch', BatchController::class);
	Route::get('/{id}/batch_max', [BatchController::class, 'max'])->name('batch.max');
	Route::post('/batch/close', [BatchController::class, 'close_batch'])->name('close_batch');
	Route::post('/batch/open', [BatchController::class, 'open_batch'])->name('open_batch');
});
