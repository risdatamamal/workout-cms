<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\CertificationTrainerController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ExperienceTrainerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberPlanController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SpecialityController;
use App\Http\Controllers\SpecialityTrainerController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\TransactionController;

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
    return redirect('/dashboard');
});

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);

Route::get('password/forget',  [ForgotPasswordController::class, 'index'])->name('password.forget');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/logout', [LoginController::class, 'logout']);
    Route::get('/clear-cache', [HomeController::class, 'clearCache']);

    // Dashboard
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    // get permissions
    Route::get('get-role-permissions-badge', [PermissionController::class, 'getPermissionBadgeByRole']);
    // get regencies by province
    Route::get('/regencies/{provinceId}', [UserController::class, 'getRegencies']);

    // Account Management
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/user/get-list', [UserController::class, 'getUserList']);
    Route::get('/user/create', [UserController::class, 'create']);
    Route::post('/user/create', [UserController::class, 'store'])->name('store-user');
    Route::get('/user/edit/{id}', [UserController::class, 'edit']);
    Route::post('/user/update', [UserController::class, 'update']);
    Route::get('/user/delete/{id}', [UserController::class, 'delete']);

    Route::get('/roles', [RolesController::class, 'index']);
    Route::get('/role/get-list', [RolesController::class, 'getRoleList']);
    Route::post('/role/create', [RolesController::class, 'create']);
    Route::get('/role/edit/{id}', [RolesController::class, 'edit']);
    Route::post('/role/update', [RolesController::class, 'update']);
    Route::get('/role/delete/{id}', [RolesController::class, 'delete']);

    Route::get('/permission', [PermissionController::class, 'index']);
    Route::get('/permission/get-list', [PermissionController::class, 'getPermissionList']);
    Route::post('/permission/create', [PermissionController::class, 'create']);
    Route::get('/permission/update', [PermissionController::class, 'update']);
    Route::get('/permission/delete/{id}', [PermissionController::class, 'delete']);

    // Admin
    Route::get('/admin', [AdminController::class, 'index']);
    Route::get('/admin/get-list', [AdminController::class, 'getAdminList']);
    Route::get('/admin/create', [AdminController::class, 'create']);
    Route::post('/admin/create', [AdminController::class, 'store'])->name('store-admin');
    Route::get('/admin/edit/{id}', [AdminController::class, 'edit']);
    Route::post('/admin/update', [AdminController::class, 'update']);
    Route::get('/admin/delete/{id}', [AdminController::class, 'delete']);

    // Trainer
    Route::get('/trainer', [TrainerController::class, 'index']);
    Route::get('/trainer/get-list', [TrainerController::class, 'getTrainerList']);
    Route::get('/trainer/create', [TrainerController::class, 'create']);
    Route::post('/trainer/create', [TrainerController::class, 'store'])->name('store-trainer');
    Route::get('/trainer/edit/{id}', [TrainerController::class, 'edit']);
    Route::post('/trainer/update', [TrainerController::class, 'update']);
    Route::get('/trainer/delete/{id}', [TrainerController::class, 'delete']);

    // Experience Trainer
    Route::get('/trainer/{trainer_id}/experience', [ExperienceTrainerController::class, 'index'])->name('experience-trainer.index');
    Route::get('/trainer/{trainer_id}/experience/get-list', [ExperienceTrainerController::class, 'getExperienceTrainerList']);
    Route::get('/trainer/{trainer_id}/experience/create', [ExperienceTrainerController::class, 'create'])->name('experience-trainer.create');
    Route::post('/trainer/{trainer_id}/experience/create', [ExperienceTrainerController::class, 'store'])->name('experience-trainer.store');
    Route::get('/trainer/{trainer_id}/experience/delete/{id}', [ExperienceTrainerController::class, 'delete'])->name('experience-trainer.delete');

    // Speciality Trainer
    Route::get('/trainer/{trainer_id}/speciality', [SpecialityTrainerController::class, 'index'])->name('speciality-trainer.index');
    Route::get('/trainer/{trainer_id}/speciality/get-list', [SpecialityTrainerController::class, 'getSpecialityTrainerList']);
    Route::get('/trainer/{trainer_id}/speciality/create', [SpecialityTrainerController::class, 'create'])->name('speciality-trainer.create');
    Route::post('/trainer/{trainer_id}/speciality/create', [SpecialityTrainerController::class, 'store'])->name('speciality-trainer.store');
    Route::get('/trainer/{trainer_id}/speciality/delete/{id}', [SpecialityTrainerController::class, 'delete'])->name('speciality-trainer.delete');

    // Certification Trainer
    Route::get('/trainer/{trainer_id}/certification', [CertificationTrainerController::class, 'index'])->name('certification-trainer.index');
    Route::get('/trainer/{trainer_id}/certification/get-list', [CertificationTrainerController::class, 'getCertificationTrainerList']);
    Route::get('/trainer/{trainer_id}/certification/create', [CertificationTrainerController::class, 'create'])->name('certification-trainer.create');
    Route::post('/trainer/{trainer_id}/certification/create', [CertificationTrainerController::class, 'store'])->name('certification-trainer.store');
    Route::get('/trainer/{trainer_id}/certification/delete/{id}', [CertificationTrainerController::class, 'delete'])->name('certification-trainer.delete');

    // Customer
    Route::get('/customer', [CustomerController::class, 'index']);
    Route::get('/customer/get-list', [CustomerController::class, 'getCustomerList']);
    Route::get('/customer/create', [CustomerController::class, 'create']);
    Route::post('/customer/create', [CustomerController::class, 'store'])->name('store-customer');
    Route::get('/customer/edit/{id}', [CustomerController::class, 'edit']);
    Route::post('/customer/update', [CustomerController::class, 'update']);
    Route::get('/customer/delete/{id}', [CustomerController::class, 'delete']);

    // Member Plans
    Route::get('/member-plan', [MemberPlanController::class, 'index']);
    Route::get('/member-plan/get-list', [MemberPlanController::class, 'getMemberPlanList']);
    Route::get('/member-plan/create', [MemberPlanController::class, 'create']);
    Route::post('/member-plan/create', [MemberPlanController::class, 'store'])->name('store-member-plan');
    Route::get('/member-plan/edit/{id}', [MemberPlanController::class, 'edit']);
    Route::post('/member-plan/update', [MemberPlanController::class, 'update']);
    Route::get('/member-plan/delete/{id}', [MemberPlanController::class, 'delete']);

    // Profile
    Route::get('/profile', function () {
        return view('pages.profile');
    });

    // Class
    Route::get('/class', [ClassController::class, 'index']);
    Route::get('/class/get-list', [ClassController::class, 'getClassList']);
    Route::get('/class/create', [ClassController::class, 'create']);
    Route::post('/class/create', [ClassController::class, 'store'])->name('store-class');
    Route::get('/class/edit/{id}', [ClassController::class, 'edit']);
    Route::post('/class/update', [ClassController::class, 'update']);
    Route::get('/class/delete/{id}', [ClassController::class, 'delete']);

    // Schedule
    Route::get('/schedule', [ScheduleController::class, 'index']);

    // Reminder
    Route::get('/reminder', [ReminderController::class, 'index']);

    // Review
    Route::get('/review', [ReviewController::class, 'index']);

    // Membership
    Route::get('/membership', [MembershipController::class, 'index']);

    // Transaction
    Route::get('/transaction', [TransactionController::class, 'index']);

    // Speciality
    Route::get('/speciality', [SpecialityController::class, 'index']);
    Route::get('/speciality/get-list', [SpecialityController::class, 'getSpecialityList']);
    Route::get('/speciality/create', [SpecialityController::class, 'create']);
    Route::post('/speciality/create', [SpecialityController::class, 'store'])->name('store-speciality');
    Route::get('/speciality/edit/{id}', [SpecialityController::class, 'edit']);
    Route::post('/speciality/update', [SpecialityController::class, 'update']);
    Route::get('/speciality/delete/{id}', [SpecialityController::class, 'delete']);

    // Permission examples
    Route::get('/permission-example', function () {
        return view('pages.permissions.example');
    });
    // API Documentation
    Route::get('/rest-api', function () {
        return view('api');
    });
    // Editable Datatable
    Route::get('/table-datatable-edit', function () {
        return view('pages.datatable-editable');
    });

    // Themekit demo pages
    Route::get('/calendar', function () {
        return view('pages.calendar');
    });
    Route::get('/charts-amcharts', function () {
        return view('pages.charts-amcharts');
    });
    Route::get('/charts-chartist', function () {
        return view('pages.charts-chartist');
    });
    Route::get('/charts-flot', function () {
        return view('pages.charts-flot');
    });
    Route::get('/charts-knob', function () {
        return view('pages.charts-knob');
    });
    Route::get('/forgot-password', function () {
        return view('pages.forgot-password');
    });
    Route::get('/form-addon', function () {
        return view('pages.form-addon');
    });
    Route::get('/form-advance', function () {
        return view('pages.form-advance');
    });
    Route::get('/form-components', function () {
        return view('pages.form-components');
    });
    Route::get('/form-picker', function () {
        return view('pages.form-picker');
    });
    Route::get('/invoice', function () {
        return view('pages.invoice');
    });
    Route::get('/layout-edit-item', function () {
        return view('pages.layout-edit-item');
    });
    Route::get('/layouts', function () {
        return view('pages.layouts');
    });

    Route::get('/navbar', function () {
        return view('pages.navbar');
    });

    Route::get('/project', function () {
        return view('pages.project');
    });
    Route::get('/view', function () {
        return view('pages.view');
    });

    Route::get('/table-bootstrap', function () {
        return view('pages.table-bootstrap');
    });
    Route::get('/table-datatable', function () {
        return view('pages.table-datatable');
    });
    Route::get('/taskboard', function () {
        return view('pages.taskboard');
    });
    Route::get('/widget-chart', function () {
        return view('pages.widget-chart');
    });
    Route::get('/widget-data', function () {
        return view('pages.widget-data');
    });
    Route::get('/widget-statistic', function () {
        return view('pages.widget-statistic');
    });
    Route::get('/widgets', function () {
        return view('pages.widgets');
    });

    // themekit ui pages
    Route::get('/alerts', function () {
        return view('pages.ui.alerts');
    });
    Route::get('/badges', function () {
        return view('pages.ui.badges');
    });
    Route::get('/buttons', function () {
        return view('pages.ui.buttons');
    });
    Route::get('/cards', function () {
        return view('pages.ui.cards');
    });
    Route::get('/carousel', function () {
        return view('pages.ui.carousel');
    });
    Route::get('/icons', function () {
        return view('pages.ui.icons');
    });
    Route::get('/modals', function () {
        return view('pages.ui.modals');
    });
    Route::get('/navigation', function () {
        return view('pages.ui.navigation');
    });
    Route::get('/notifications', function () {
        return view('pages.ui.notifications');
    });
    Route::get('/range-slider', function () {
        return view('pages.ui.range-slider');
    });
    Route::get('/rating', function () {
        return view('pages.ui.rating');
    });
    Route::get('/session-timeout', function () {
        return view('pages.ui.session-timeout');
    });
    Route::get('/pricing', function () {
        return view('pages.pricing');
    });
});
