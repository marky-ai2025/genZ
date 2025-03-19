<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InsertRecord;
use App\Http\Controllers\QrController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\CountController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\InternController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\UserStatController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VideoCallController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\InternshipController;
use App\Http\Controllers\StudentImportController;
use App\Http\Controllers\SchoolController;



Route::get('/', function () {
    return redirect('/login'); 
});

Route::get('/home', function () {
    return view('dashboard.index');
});

Route::get('/homeuser', function () {
    return view('dashboard.users');
});


Route::get('/dashboard', function () {
    return view('admin.dashboard');
});
Route::get('/students-information', function (){
    return view('admin.studentinformation');
});

Route::get('/students-evaluation', function (){
    return view('admin.evaluation');
});

Route::get('/admin-account', function (){
    return view('admin.account');
    });

    
Route::get('/user-message', function (){
    return view('user.message');
    });
    Route::get('/admin-chat', function (){
        return view('admin.chat');
        });
    
        Route::get('/user-chat', function (){
            return view('user.chat');
            });

            Route::get('/schedule', function (){
                return view('admin.schedule');
                });

                Route::get('/request', function (){
                    return view('user.request');
                    });
                    Route::get('/approved-admin', function (){
                        return view('admin.approved');
                        });
                        Route::get('/approved-user', function (){
                            return view('user.approved');
                            });
                            Route::get('/insertRecord-admin', function (){
                                return view('admin.insertRecord');
                                });
                           
                                Route::get('/qr', function (){
                                    return view('admin.qr');
                                    });
                               
                   
        
    

                
    




Route::get('Student/getStudents', [StudentController::class ,'getStudents']);
Route::get('Student', [StudentController::class ,'index']);
Route::post('Student/add', [StudentController::class ,'store'])->name('Student.add');
Route::post('/Student/delete/{id}', [StudentController::class, 'destroy']);

Route::post('Student/update/{id}', [StudentController::class, 'update']);

Route::get('Student/{id}/edit', [StudentController::class, 'edit']);

Route::post('Student/upload', [StudentController::class, 'uploadExcel'])->name('students.upload');

// for my excel


Route::get('/user', function (){
    return view('dashboard.users');
});

Route::get('/students/list', [StudentController::class, 'getStudents'])->name('students.list'); // DataTable data
Route::get('/students/count', [StudentController::class, 'getStudentCount'])->name('students.count'); // Student count
Route::post('/students/store', [StudentController::class, 'store'])->name('students.store'); // Add student


//dashboard Counting

Route::get('/count-students', [CountController::class, 'countStudents']);
Route::get('/count-programs', [CountController::class, 'countByProgram']);
Route::get('/count-gender', [CountController::class, 'countByGender']);
Route::get('/dashboard/courses', [CountController::class, 'countStudentsByCourse']);
Route::get('/dashboard', [CountController::class, 'index'])->name('dashboard.index');

Route::get('/api/students-by-schools', action: [CountController::class, 'getStudentBySchools'])->name('getStudentBySchools');




//import

Route::post('/import-students', [StudentImportController::class, 'import'])->name('import.students');



//auth

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'prevent-back'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])
        ->name('dashboard.index')
        ->middleware('admin'); 

    Route::get('/user/dashboard', [DashboardController::class, 'usersDashboard'])
        ->name('dashboard.users');
});



Route::middleware(['auth'])->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit'); // Edit page
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});


Route::get('/chat', [ChatController::class, 'index']);
Route::post('/send-message', [ChatController::class, 'sendMessage']);
Route::get('/get-messages', [ChatController::class, 'getMessages']);





Route::get('/admin/schedule', [ScheduleController::class, 'index']);


Route::get('/schedules/fetch', [ScheduleController::class, 'fetchSchedules']);
Route::post('/schedule/store', [ScheduleController::class, 'store']);
Route::post('/schedule/update/{id}', [ScheduleController::class, 'update']);
Route::delete('/schedule/delete/{id}', [ScheduleController::class, 'destroy']);
Route::put('/schedule/approve/{id}', [ScheduleController::class, 'approveRequest']);
Route::get('/approved/admin', [ScheduleController::class, 'fetchApprovedRequests']);



Route::get('/qr', [QrController::class, 'index'])->name('qr_page');
Route::post('/register-qr', [QrController::class, 'registerQr'])->name('register_qr');
Route::post('/scan-qr', [QrController::class, 'scanQr'])->name('scan_qr');

//jm module
Route::resource('school', SchoolController::class);