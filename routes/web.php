<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\managePaymentController;
use App\Http\Controllers\StudentRegistrationController;

// Change this to change the default page
Route::get('/', function () {
    if (Auth::check()) {
        if (Auth::user()->role != 'KAFAadmin') {
            return redirect('users'); //Put Teacher or Parent View here
        } else {
            return redirect("users"); //Put Admins View here
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
        if (Auth::user()->role != 'KAFAadmin' || Auth::user()->role != 'MUIPadmin' || Auth::user()->role != 'teacher') {
            return view('dashboard'); //Put Teacher or Parent View here
        } else {
            return redirect("users"); //Put Admins View here
        }
    });
});

// Student Registration Module Tan
// Only KAFA Admin can access this route
Route::middleware('role:KAFAadmin')->group(function () {
    Route::get('/studentRegistration', [StudentRegistrationController::class, 'index'])->name('ManageStudentRegistration.StudentRegistrationList');
    Route::get('/studentRegistration/add', [StudentRegistrationController::class, 'create'])->name('ManageStudentRegistration.AddStudentRegistrationForm');
    Route::post('/studentRegistration/store', [StudentRegistrationController::class, 'store'])->name('storeStudentRegistration');
    Route::get('/studentRegistration/show/{student_id}', [StudentRegistrationController::class, 'show'])->name('ManageStudentRegistration.ViewStudentRegistrationForm');
    Route::get('/studentRegistration/edit/{id}', [StudentRegistrationController::class, 'edit'])->name('ManageStudentRegistration.EditStudentRegistrationForm');
    Route::post('/studentRegistration/update/{id}', [StudentRegistrationController::class, 'update'])->name('ManageStudentRegistration.UpdateStudentRegistration');
    Route::post('/studentRegistration/delete/{id}', [StudentRegistrationController::class, 'destroy'])->name('deleteStudentRegistration');
    // Route to approve a student registration
    Route::post('/students/{student_id}/approve', [StudentRegistrationController::class, 'approveStudentRegistration'])->name('approveStudentRegistration');

    // Route to reject a student registration
    Route::post('/students/{student_id}/reject', [StudentRegistrationController::class, 'rejectStudentRegistration'])->name('rejectStudentRegistration');

    Route::post('/studentRegistrationReport/view', [StudentRegistrationController::class, 'indexStudentReport'])->name('ManageStudentRegistration.ViewStudentRegistrationReport');
    Route::post('/studentRegistrationReport', [StudentRegistrationController::class, 'indexStudentReport'])->name('studentRegistrationReport');
    Route::get('/studentRegistrationReport/csv', [StudentRegistrationController::class, 'exportStudentCSV'])->name('student.csv');
    Route::get('/studentRegistrationReport/data/{range}', [StudentRegistrationController::class, 'getAgeData'])->name('ManageStudentAgeData');
});

// Student Registration Module Tan
// Only MUIP Admin can access this route
Route::middleware('role:MUIPadmin')->group(function () {
    Route::get('/studentRegistration', [StudentRegistrationController::class, 'index'])->name('ManageStudentRegistration.StudentRegistrationList');
    Route::get('/studentRegistration/show/{student_id}', [StudentRegistrationController::class, 'show'])->name('ManageStudentRegistration.ViewStudentRegistrationForm');
    Route::post('/studentRegistrationReport/view', [StudentRegistrationController::class, 'indexStudentReport'])->name('ManageStudentRegistration.ViewStudentRegistrationReport');
    Route::post('/studentRegistrationReport', [StudentRegistrationController::class, 'indexStudentReport'])->name('studentRegistrationReport');
    Route::get('/studentRegistrationReport/csv', [StudentRegistrationController::class, 'exportStudentCSV'])->name('student.csv');
    Route::get('/studentRegistrationReport/data/{range}', [StudentRegistrationController::class, 'getAgeData'])->name('ManageStudentAgeData');
});


// Student Registration Module Tan
// Only Parent can access this route
Route::middleware('role:Parent')->group(function () {
    Route::get('/studentRegistration', [StudentRegistrationController::class, 'index'])->name('ManageStudentRegistration.StudentRegistrationList');
    Route::get('/studentRegistration/add', [StudentRegistrationController::class, 'create'])->name('ManageStudentRegistration.AddStudentRegistrationForm');
    Route::post('/studentRegistration/store', [StudentRegistrationController::class, 'store'])->name('storeStudentRegistration');
    Route::get('/studentRegistration/show/{student_id}', [StudentRegistrationController::class, 'show'])->name('ManageStudentRegistration.ViewStudentRegistrationForm');
    Route::get('/studentRegistration/edit/{id}', [StudentRegistrationController::class, 'edit'])->name('ManageStudentRegistration.EditStudentRegistrationForm');
    Route::post('/studentRegistration/update/{id}', [StudentRegistrationController::class, 'update'])->name('ManageStudentRegistration.UpdateStudentRegistration');
});

// Student Registration Module Tan
// Only Teacher can access this route
Route::middleware('role:Teacher')->group(function () {
    Route::get('/studentRegistration', [StudentRegistrationController::class, 'index'])->name('ManageStudentRegistration.StudentRegistrationList');
    Route::get('/studentRegistration/show/{student_id}', [StudentRegistrationController::class, 'show'])->name('ManageStudentRegistration.ViewStudentRegistrationForm');
    // Route to approve a student registration
    Route::post('/students/{student_id}/approve', [StudentRegistrationController::class, 'approveStudentRegistration'])->name('approveStudentRegistration');
    // Route to reject a student registration
    Route::post('/students/{student_id}/reject', [StudentRegistrationController::class, 'rejectStudentRegistration'])->name('rejectStudentRegistration');

    Route::post('/studentRegistrationReport/view', [StudentRegistrationController::class, 'indexStudentReport'])->name('ManageStudentRegistration.ViewStudentRegistrationReport');
    Route::post('/studentRegistrationReport', [StudentRegistrationController::class, 'indexStudentReport'])->name('studentRegistrationReport');
    Route::get('/studentRegistrationReport/csv', [StudentRegistrationController::class, 'exportStudentCSV'])->name('student.csv');
    Route::get('/studentRegistrationReport/data/{range}', [StudentRegistrationController::class, 'getAgeData'])->name('ManageStudentAgeData');
});


// View Payment Module Wan
// Only KAFA Admin and MUIP Admin can access this route
Route::middleware('role:KAFAadmin,MUIPadmin')->group(function () {
    Route::get('/viewPaymentList', [managePaymentController::class, 'receiptList'])->name('viewReceiptListPage');
    Route::get('/viewPaymentList/editReceiptPage/{id}', [managePaymentController::class, 'edit'])->name('editReceiptPage');
    Route::post('/viewPaymentList/update/{id}', [managePaymentController::class, 'update'])->name('update');
    Route::post('/viewPaymentList/delete/{id}', [managePaymentController::class, 'delete'])->name('delete');
});

// View Payment Module Wan
// Only Parent can access this route
Route::middleware('role:parent')->group(function () {
    Route::get('/choosePayMethod', [managePaymentController::class, 'choosePayMethod'])->name('choosePayMethodPage');
    Route::get('/choosePayMethod/cardForm', [managePaymentController::class, 'cardMethodcreate'])->name('debitCreditCardFormPage');
    Route::get('/choosePayMethod/ewalletForm', [managePaymentController::class, 'walletMethodcreate'])->name('EWalletFormPage');
    Route::post('/choosePayMethod/cardForm/insert', [managePaymentController::class, 'cardMethodinsert'])->name('insertCardForm');
    Route::post('/choosePayMethod/ewalletForm/insert', [managePaymentController::class, 'walletMethodinsert'])->name('insertWalletForm');
});

// Announcement & User Module
// Only KAFA Admin & MUIP Admin can access this route
Route::middleware('role:KAFAadmin,MUIPadmin')->group(function () {
    // User Module
    Route::get('/users', [UserController::class, 'index'])->name('user');
    Route::get('/users/add', [UserController::class, 'create'])->name('addUser');
    Route::post('/users/store', [UserController::class, 'store'])->name('storeUser');
    Route::get('/users/edit', [UserController::class, 'edit'])->name('editUser');
    Route::post('/users/update', [UserController::class, 'update'])->name('updateUser');
    Route::delete('/users/delete', [UserController::class, 'destroy'])->name('deleteUser');
});