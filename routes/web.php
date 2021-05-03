<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth'])->name('dashboard');

//for all
Route::group(['middleware' => ['auth']], function (){
    Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard');
    Route::get('/student/profile/{student_id}', 'App\Http\Controllers\StudentController@student_profile')->name('student.profile');
    Route::get('/teacher/profile/{teacher_id}', 'App\Http\Controllers\TeacherController@teacher_profile')->name('teacher.profile');

});

//for students
Route::group(['middleware' => ['auth','role:student']], function (){
    Route::get('student/room/{room_id}', 'App\Http\Controllers\StudentController@student_room')->name('student.room');
    Route::get('student/lesson/{lesson_id}', 'App\Http\Controllers\StudentController@show_lesson')->name('room.lesson');
    Route::get('student/lesson/download/{lesson_id}', 'App\Http\Controllers\StudentController@download')->name('lesson.download');
    Route::get('/myclasses', 'App\Http\Controllers\StudentController@my_class')->name('student.class');


});

Route::group(['middleware' => ['auth','role:teacher']], function (){
    Route::get('/rooms/show', 'App\Http\Controllers\TeacherController@show')->name('room.show');
    Route::get('/room/create', 'App\Http\Controllers\TeacherController@create')->name('room.create');
    Route::post('/room/create', 'App\Http\Controllers\TeacherController@store')->name('room.store');
    Route::get('/room/{room_id}', 'App\Http\Controllers\TeacherController@detiles')->name('room.detiles');
    Route::get('/lesson/{lesson_id}', 'App\Http\Controllers\LessonController@room_lesson')->name('room.lesson');
    Route::get('/lesson/create/{room_id}', 'App\Http\Controllers\LessonController@lesson_create')->name('lesson.create');
    Route::post('/lesson/create/{room_id}', 'App\Http\Controllers\LessonController@lesson_store')->name('lesson.store');
    Route::get('/lesson/download/{lesson_id}', 'App\Http\Controllers\LessonController@file_download')->name('lesson.download');
    Route::get('/mark/create/{room_id}', 'App\Http\Controllers\MarkController@mark')->name('mark.create');
    Route::post('/mark/create/{room_id}', 'App\Http\Controllers\MarkController@mark_store')->name('mark.store');
    Route::get('/edit/mark/{room_id}/{std_id}', 'App\Http\Controllers\MarkController@mark_edit')->name('mark.edit');
    Route::put('/edit/mark/{room_id}/{std_id}', 'App\Http\Controllers\MarkController@mark_update')->name('mark.update');
    Route::get('/room/students/{room_id}', 'App\Http\Controllers\TeacherController@show_students')->name('students.show');
    Route::post('/student/room/{room_id}', 'App\Http\Controllers\TeacherController@add_student')->name('student.enroll');



});

Route::group(['middleware' => ['auth','role:admin']], function (){
    Route::get('/admin/rooms/show', 'App\Http\Controllers\AdminController@show')->name('admin.room.show');
    Route::get('/admin/room/{room_id}', 'App\Http\Controllers\AdminController@detiles')->name('admin.room.detiles');
    Route::get('/admin/lesson/{lesson_id}', 'App\Http\Controllers\AdminController@room_lesson')->name('admin.room.lesson');
    Route::get('/admin/lesson/download/{lesson_id}', 'App\Http\Controllers\AdminController@file_download')->name('admin.lesson.download');
    Route::get('/admin/room/students/{room_id}', 'App\Http\Controllers\AdminController@show_students')->name('admin.students.show');
    Route::get('/admin/student/room/{room_id}', 'App\Http\Controllers\AdminController@student_room')->name('admin.student.room');
    Route::get('/admin/student/lesson/{lesson_id}', 'App\Http\Controllers\AdminController@show_lesson')->name('admin.room.lesson');
    Route::get('/admin/allusers', 'App\Http\Controllers\AdminController@all_users')->name('admin.all_users');

});

require __DIR__.'/auth.php';
