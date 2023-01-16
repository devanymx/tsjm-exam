<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\PublicController;
use App\Models\QuestionAnswer;
use Illuminate\Support\Facades\DB;
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
    return redirect('login');
});

//Errors
Route::get('/forbidden', [PublicController::class, 'defaultTemplate'])->name('forbidden');

//Verify
Route::get('/verify/{uuid}',[ExamController::class,'verifyExam'])->name('exam.verify');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard',[AdminController::class,'showDashboard'])->name('dashboard');


    //Exam
    Route::get('/exam', [ExamController::class,'showExam'])->name('exam.show');
    Route::post('/exam/start', [ExamController::class,'startExam'])->name('exam.start');
    Route::get('/exam/answer', [ExamController::class,'answerExam'])->name('exam.answer');
    Route::post('/exam/answer/questions', [ExamController::class,'answerQuestions'])->name('exam.answer.questions');
    Route::post('/exam/finished', [ExamController::class,'finishedExam'])->name('exam.finished');
    Route::get('/exam/end', [ExamController::class,'getFinished'])->name('exam.getFinished');

});
