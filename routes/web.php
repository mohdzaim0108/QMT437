<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\QuestionResponseController;
use App\Http\Controllers\QuestionFormController;
use App\Http\Controllers\QuestionAnswerController;
use App\Http\Controllers\QuestionListController;
use App\Http\Controllers\HomeController;
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

// INDEX BEFORE LOGIN
Route::get('/', function () {
    return view('auth/login');
});
Auth::routes();

// REGISTER PAGE
Route::get('auth/register', function () {
    return view('register');
});
Route::get('/register-success', [RegisterController::class, 'showRegistrationSuccess'])->name('register.success');

// LOGIN
Route::get('/lecturer', function() {return view('lecturer');})->name('lecturer')->middleware('lecturer');
Route::get('/lecturer', [HomeController::class, 'lecturerData'])->name('lecturerData');

Route::get('/student', function() {return view('student');})->name('student')->middleware('student');
Route::get('/student', [HomeController::class, 'studentData'])->name('studentData');

//Lecturer display all question
Route::get('/listQuestionL', [App\Http\Controllers\QuestionListController::class, 'questionListL'])->name('listQuestionL'); //display question & search function
Route::delete('/listQuestionL/{questionId}', [App\Http\Controllers\QuestionListController::class, 'destroyQuestion'])->name('deleteQuestion');

//view question
Route::get('/viewQuestionL/{questionId}', [QuestionListController::class, 'viewQuestionL']);
Route::get('/viewQuestionS/{questionId}', [QuestionListController::class, 'viewQuestionS']);

//update question
Route::get('editQuestion/{questionId}', [QuestionFormController::class, 'editQuestion'])->name('editQuestion');
Route::put('/updateQuestion/{questionId}', [QuestionFormController::class, 'updateQuestion'])->name('updateQuestion');

//Student display all question
Route::get('/listQuestionS', [App\Http\Controllers\QuestionListController::class, 'questionListS'])->name('listQuestionS'); //display question & search function

//QuestionForm
Route::get('/questionForm', [QuestionFormController::class, 'all']);
Route::post('/questionForm', [QuestionFormController::class, 'store'])->name('addQuestion');

//Answer Question
Route::get('/questionAnswer/{questionId}', [App\Http\Controllers\QuestionAnswerController::class, 'questionAnswer'])->name('questionAnswer');
Route::post('/questionAnswer/{questionId}/{questionStepId}', [App\Http\Controllers\QuestionAnswerController::class, 'checkAnswer'])->name('checkAnswer');
Route::get('/summaryAnswer/{questionId}', [App\Http\Controllers\QuestionAnswerController::class, 'summaryAnswer'])->name('summaryAnswer');

//Result Response
Route::get('/resultResponse', [QuestionResponseController::class, 'showChart'])->name('resultResponse');









