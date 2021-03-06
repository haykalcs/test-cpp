<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\ClasController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\KeyController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TestController;
use App\Models\Key;
use App\Models\Question;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return redirect('/login');
});

Auth::routes([
    'register' => false,
    'verify' => false,
    'reset' => false,
]);


Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::group(['as' => 'admin.', 'middleware' => ['role:admin']], function() {
        Route::resource('kelas', ClasController::class);
        Route::group(['prefix' => 'kelas/{kelasId}'], function() {
            Route::resource('siswa', StudentController::class);
        });
        Route::resource('guru', TeacherController::class);
    });

    Route::group(['as' => 'student.', 'middleware' => ['role:student']], function() {
        Route::get('tes/{competency:slug}', [TestController::class, 'show'])->name('test.show');
        Route::get('tes/{competency:slug}/started', [TestController::class, 'start'])->name('test.start');
        Route::get('tes/{competency:slug}/hasil', [TestController::class, 'result'])->name('test.result');
        Route::get('tes/{competency:slug}/hasil/{id}', [TestController::class, 'showResult'])->name('test.result.show');
        Route::post('tes/{competency:slug}', [TestController::class, 'storeResult'])->name('test.store');

        Route::get('hasil-tes-siswa', [TestController::class, 'studentResult'])->name('result');

        Route::post('execute', [TestController::class, 'execute'])->name('execute');
    });

    Route::group(['as' => 'teacher.', 'middleware' => ['role:teacher']], function() {
        Route::get('hasil-tes', [TestController::class, 'teacherResult'])->name('result');
        Route::get('hasil-tes/{competency:slug}/{id}', [TestController::class, 'showTeacherResult'])->name('result.show');

        Route::get('siswa', [DataController::class, 'student'])->name('student.index');
        Route::get('siswa/{id}', [DataController::class, 'studentShow'])->name('student.show');

        Route::group(['prefix' => '{competency:slug}'], function() {
            Route::resource('pertanyaan', QuestionController::class);
            Route::resource('pertanyaan/{question}/butir-jawaban', AnswerController::class);
        });
        Route::resource('{question}/butir-jawaban/{answer}/kunci-jawaban', KeyController::class);
    });

    Route::get('profil', [DataController::class, 'profile'])->name('profile.index');
    Route::put('profil', [DataController::class, 'updateProfile'])->name('profile.update');
});
