<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Home
use App\Http\Controllers\HomeController;

// ===============================
// ADMIN CONTROLLERS
// ===============================
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\EmployeeController as AdminEmployeeController;
use App\Http\Controllers\Admin\LeaveController as AdminLeaveController;
use App\Http\Controllers\Admin\ExpenseController as AdminExpenseController;
use App\Http\Controllers\Admin\HolidayController as AdminHolidayController;
use App\Http\Controllers\Admin\PenggajianController;

// ===============================
// EMPLOYEE CONTROLLERS
// ===============================
use App\Http\Controllers\Employee\EmployeeController;
use App\Http\Controllers\Employee\AttendanceController;
use App\Http\Controllers\Employee\LeaveController as EmployeeLeaveController;
use App\Http\Controllers\Employee\ExpenseController as EmployeeExpenseController;
use App\Http\Controllers\Employee\SelfController;

// ===============================
// DEFAULT → LOGIN
// ===============================

Route::get('/', fn() => redirect()->route('login'));
Auth::routes(['register' => false]);

// Override /home
Route::get('/home', fn() => redirect('/login'))->name('home');


// ======================================================================
// ADMIN ROUTES
// ======================================================================

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'can:admin-access'])
    ->group(function () {

    // Dashboard
    Route::get('/', [AdminController::class, 'index'])->name('index');

    // Profile
    Route::get('/profile', [AdminController::class, 'adminProfile'])->name('profile');
    Route::get('/profile-edit', [AdminController::class, 'profile_edit'])->name('profile.edit');
    Route::put('/profile', [AdminController::class, 'profile_update'])->name('profile.update');

    // Reset Password
    Route::get('/reset-password', [AdminController::class, 'reset_password'])->name('reset-password');
    Route::put('/update-password', [AdminController::class, 'update_password'])->name('update-password');

    // Employees
    Route::prefix('employees')->name('employees.')->group(function () {
        Route::get('list-employees', [AdminEmployeeController::class, 'index'])->name('index');

        Route::get('add-employee', [AdminEmployeeController::class, 'create'])->name('create');
        Route::post('/', [AdminEmployeeController::class, 'store'])->name('store');

        Route::get('attendance', [AdminEmployeeController::class, 'attendance'])->name('attendance');
        Route::post('attendance', [AdminEmployeeController::class, 'attendance'])->name('attendance.filter');
        Route::delete('attendance/{attendance_id}', [AdminEmployeeController::class, 'attendanceDelete'])->name('attendance.delete');

        Route::get('profile/{employee_id}', [AdminEmployeeController::class, 'employeeProfile'])->name('profile');
        Route::delete('/{employee_id}', [AdminEmployeeController::class, 'destroy'])->name('delete');
    });

    // Leaves
    Route::prefix('leaves')->name('leaves.')->group(function () {
        Route::get('list-leaves', [AdminLeaveController::class, 'index'])->name('index');
        Route::put('{leave_id}', [AdminLeaveController::class, 'update'])->name('update');
    });

    // Expenses
    Route::prefix('expenses')->name('expenses.')->group(function () {
        Route::get('list-expenses', [AdminExpenseController::class, 'index'])->name('index');
        Route::put('{expense_id}', [AdminExpenseController::class, 'update'])->name('update');

        Route::get('setting/overtime', [AdminExpenseController::class, 'setting_index'])->name('setting_index');
        Route::get('setting/overtime-edit/{department_id}', [AdminExpenseController::class, 'setting_edit'])->name('setting_edit');
        Route::put('setting/overtime-update/{department_id}', [AdminExpenseController::class, 'setting_update'])->name('setting_update');
    });

    // Holidays
    Route::prefix('holidays')->name('holidays.')->group(function () {
        Route::get('list-holidays', [AdminHolidayController::class, 'index'])->name('index');
        Route::get('add-holiday', [AdminHolidayController::class, 'create'])->name('create');
        Route::post('/', [AdminHolidayController::class, 'store'])->name('store');
        Route::get('edit-holiday/{holiday_id}', [AdminHolidayController::class, 'edit'])->name('edit');
        Route::put('{holiday_id}', [AdminHolidayController::class, 'update'])->name('update');
        Route::delete('{holiday_id}', [AdminHolidayController::class, 'destroy'])->name('delete');
    });

    // Payroll
    Route::prefix('penggajian')->name('penggajian.')->group(function () {
        Route::get('/', [PenggajianController::class, 'index'])->name('index');
        Route::get('tambah', [PenggajianController::class, 'create'])->name('create');
        Route::post('/', [PenggajianController::class, 'store'])->name('store');
    });

});


// ======================================================================
// EMPLOYEE ROUTES
// ======================================================================

Route::prefix('employee')
    ->name('employee.')
    ->middleware(['auth', 'can:employee-access'])
    ->group(function () {

    Route::get('/', [EmployeeController::class, 'index'])->name('index');

    // Profile
    Route::get('/profile', [EmployeeController::class, 'profile'])->name('profile');
    Route::get('/profile-edit', [EmployeeController::class, 'profile_edit'])->name('profile.edit');
    Route::put('/profile', [EmployeeController::class, 'profile_update'])->name('profile.update');

    Route::get('/reset-password', [EmployeeController::class, 'reset_password'])->name('reset-password');
    Route::put('/update-password', [EmployeeController::class, 'update_password'])->name('update-password');

    // Attendance
    Route::prefix('attendance')->name('attendance.')->group(function () {
            Route::get('list-attendances', [AttendanceController::class, 'index'])->name('index');
            Route::post('list-attendances', [AttendanceController::class, 'index'])->name('filter');

            // NOTE: gunakan 'getLocation' sesuai controller method
            Route::post('get-location', [AttendanceController::class, 'getLocation'])->name('get-location');

            Route::get('register', [AttendanceController::class, 'create'])->name('create');
            Route::post('{employee_id}', [AttendanceController::class, 'store'])->name('store');
            Route::put('{attendance_id}', [AttendanceController::class, 'update'])->name('update');
    });

    // Leaves
    Route::prefix('leaves')->name('leaves.')->group(function () {
        Route::get('apply', [EmployeeLeaveController::class, 'create'])->name('create');
        Route::get('list-leaves', [EmployeeLeaveController::class, 'index'])->name('index');
        Route::post('{employee_id}', [EmployeeLeaveController::class, 'store'])->name('store');
        Route::get('edit-leave/{leave_id}', [EmployeeLeaveController::class, 'edit'])->name('edit');
        Route::put('{leave_id}', [EmployeeLeaveController::class, 'update'])->name('update');
        Route::delete('{leave_id}', [EmployeeLeaveController::class, 'destroy'])->name('delete');
    });

    // Expenses
    Route::prefix('expenses')->name('expenses.')->group(function () {
        Route::get('list-expenses', [EmployeeExpenseController::class, 'index'])->name('index');
        Route::get('claim-expense', [EmployeeExpenseController::class, 'create'])->name('create');
        Route::post('{employee_id}', [EmployeeExpenseController::class, 'store'])->name('store');
        Route::get('edit-expense/{expense_id}', [EmployeeExpenseController::class, 'edit'])->name('edit');
        Route::put('{expense_id}', [EmployeeExpenseController::class, 'update'])->name('update');
        Route::delete('{expense_id}', [EmployeeExpenseController::class, 'destroy'])->name('delete');
    });

    // Self-service
    Route::get('/self/holidays', [SelfController::class, 'holidays'])->name('self.holidays');
    Route::get('/self/salary_slip', [SelfController::class, 'salary_slip'])->name('self.salary_slip');
    Route::get('/self/salary_slip_print', [SelfController::class, 'salary_slip_print'])->name('self.salary_slip_print');
});


// ======================================================================
// FALLBACK
// ======================================================================

Route::fallback(function () {
    if (auth()->check()) {
        return auth()->user()->role === 'admin'
            ? redirect()->route('admin.index')
            : redirect()->route('employee.index');
    }
    return redirect()->route('login');
});
