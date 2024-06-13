<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\StudentRegistrationController;

// Change this to change the default page
Route::get('/', function () {
    if (Auth::check()) {
        if (Auth::user()->role != 'admin') {
            return redirect('/dashboard');
        }
        else {
            return redirect("/dashboard/announcements");
        }
    } else {
        return redirect()->route('login');
    }
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        if (Auth::user()->role != 'admin') {
            return view('dashboard');
        }
        else {
            return redirect("/dashboard/announcements");
        }
    })->name('dashboard');
});

// Student Registration  Module
Route::get('/studentRegistration', [StudentRegistrationController::class, 'index'])->name('ManageStudentRegistration.StudentRegistrationList');
Route::get('/studentRegistration/add', [StudentRegistrationController::class, 'create'])->name('ManageStudentRegistration.AddStudentRegistrationForm');
Route::post('/studentRegistration/store', [StudentRegistrationController::class, 'store'])->name('storeStudentRegistration');
Route::get('/studentRegistration/show/{student_id}', [StudentRegistrationController::class, 'show'])->name('ManageStudentRegistration.ViewStudentRegistrationForm');
Route::get('/studentRegistration/edit/{id}', [StudentRegistrationController::class, 'edit'])->name('ManageStudentRegistration.EditStudentRegistrationForm');
Route::post('/studentRegistration/update/{id}', [StudentRegistrationController::class, 'update'])->name('ManageStudentRegistration.UpdateStudentRegistration');
Route::post('/studentRegistration/delete/{id}', [StudentRegistrationController::class, 'destroy'])->name('deleteStudentRegistration');
Route::post('/studentRegistration/{student_id}/update-status', [StudentRegistrationController::class, 'updateStatus'])->name('updateStudentStatus');
Route::post('/studentRegistrationReport/view', [StudentRegistrationController::class, 'indexStudentReport'])->name('ManageStudentRegistration.ViewStudentRegistrationReport');
Route::post('/studentRegistrationReport', [StudentRegistrationController::class, 'indexStudentReport'])->name('studentRegistrationReport');
Route::get('/studentRegistrationReport/csv', [StudentRegistrationController::class, 'exportStudentCSV'])->name('student.csv');
Route::get('/studentRegistrationReport/data/{range}', [StudentRegistrationController::class, 'getAgeData'])->name('ManageStudentAgeData');


// View Payment Module
// Only Admin can access this route
Route::middleware('role:admin')->group(function () {
    // View list of payments
    Route::get('/payment', [PaymentController::class, 'index'])->name('payment.index')->middleware('role:admin');
    Route::get('/payment/create', [PaymentController::class, 'create'])->name('payment.create');
    Route::post('/payment/insert', [PaymentController::class, 'insert'])->name('payment.insert');
    Route::get('/payment/edit/{id}', [PaymentController::class, 'edit'])->name('payment.edit');
    Route::post('/payment/update/{id}', [PaymentController::class, 'update'])->name('payment.update');
    Route::post('/payment/delete/{id}', [PaymentController::class, 'delete'])->name('payment.delete');
});

// View Payment Module
// Only User/Cashier can access this route
Route::middleware('role:cashier')->group(function () {
    Route::get('/viewPayment', [PaymentController::class, 'userIndex'])->name('payment.userIndex')->middleware('role:cashier');
    Route::post('/viewPayment/insert/{userName}', [PaymentController::class, 'updateUser'])->name('payment.userInsert');
});

//Report Module
// Only Admin and Coordinator can access this route
Route::middleware('role:admin,coordinator')->group(function () {
    Route::get('/report', [ReportController::class, 'index'])->name('report');
    Route::post('/report', [ReportController::class, 'index'])->name('report');
    Route::get('report/data/{range}', [ReportController::class, 'getData'])->name('report.data');
    Route::get('/report/export', [ReportController::class, 'exportCSV'])->name('csv');
});

// Announcement & User Module
// Only Admin can access this route
Route::middleware('role:admin')->group(function () {
    // Announcement Module
    Route::get('/dashboard/announcements', [AnnouncementController::class, 'index'])->name('announcement');
    Route::get('/announcements/add', [AnnouncementController::class, 'create'])->name('addAnnouncement');
    Route::post('/announcements/store', [AnnouncementController::class, 'store'])->name('storeAnnouncement');
    Route::get('/announcements/edit/{id}', [AnnouncementController::class, 'edit'])->name('editAnnouncement');
    Route::post('/announcements/update/{id}', [AnnouncementController::class, 'update'])->name('updateAnnouncement');
    Route::post('/announcements/delete/{id}', [AnnouncementController::class, 'destroy'])->name('deleteAnnouncement');

    // User Module
    Route::get('/users', [UserController::class, 'index'])->name('user');
    Route::get('/users/add', [UserController::class, 'create'])->name('addUser');
    Route::post('/users/store', [UserController::class, 'store'])->name('storeUser');
    Route::get('/users/edit', [UserController::class, 'edit'])->name('editUser');
    Route::post('/users/update', [UserController::class, 'update'])->name('updateUser');
    Route::delete('/users/delete', [UserController::class, 'destroy'])->name('deleteUser');
});

// All user can access this route
Route::get('/announcementList', [AnnouncementController::class, 'announcementList'])->name('announcementList');
