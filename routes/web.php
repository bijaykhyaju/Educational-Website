<?php

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

/*
|--------------------------------------------------------------------------
| Admin panel Web Routes
|--------------------------------------------------------------------------

*/

Route::get('/login', function () {
  return view('login');
});
Auth::routes();

Route::get('/courses', 'LessonController@index');

Route::get('/courses/add', 'LessonController@addEditPage');

Route::post('/courses/insert', 'LessonController@store');

Route::post('/courses/delete', 'LessonController@destroy');

Route::get('/courses/edit/{id}', 'LessonController@addEditPage');

Route::get('/tests', 'TestController@index');

Route::get('/tests/add', 'TestController@addEditTestPage');

Route::post('/tests/insert', 'TestController@store');



/*
|--------------------------------------------------------------------------
| Front-end Web Routes
|--------------------------------------------------------------------------

*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/learn_numbers', function () {
    return view('learn_numbers');
});

Route::get('/one', function () {
    return view('one');
});

Route::get('/a', function () {
    return view('a');
});

Route::get('/lessonone-a', function () {
  return view('lc/lessonone-a');
});

Route::get('/lessonone-b', function () {
  return view('lc/lessonone-b');
});

Route::get('/lessonone-c', function () {
  return view('lc/lessonone-c');
});

Route::get('/lessonone-quiz', function () {
  return view('lc/lessonone-quiz');
});

Route::get('/quizone-fail', function () {
  return view('lc/quizone-fail');
});

Route::get('/quizone-pass', function () {
  return view('lc/quizone-pass');
});

Route::get('/lessontwo-a', function () {
  return view('lc/lessontwo-a');
});

Route::get('/lessontwo-b', function () {
  return view('lc/lessontwo-b');
});

Route::get('/lessontwo-c', function () {
  return view('lc/lessontwo-c');
});

Route::get('/lessontwo-quiz-a', function () {
  return view('lc/lessontwo-quiz-a');
});

Route::get('/quiztwo-fail', function () {
  return view('lc/quiztwo-fail');
});

Route::get('/quiztwo-pass', function () {
  return view('lc/quiztwo-pass');
});

Route::get('/lessontwo-quiz-b', function () {
  return view('lc/lessontwo-quiz-b');
});

Route::get('/lessonthree-a', function () {
  return view('lc/lessonthree-a');
});

Route::get('/lessonthree-b', function () {
  return view('lc/lessonthree-b');
});

Route::get('/lessonthree-c', function () {
  return view('lc/lessonthree-c');
});

Route::get('/lessonthree-quiz-a', function () {
  return view('lc/lessonthree-quiz-a');
});

Route::get('/quizthree-fail', function () {
  return view('lc/quizthree-fail');
});

Route::get('/lessonthree-quiz-b', function () {
  return view('lc/lessonthree-quiz-b');
});

Route::get('/lessonthree-quiz-c', function () {
  return view('lc/lessonthree-quiz-c');
});

Route::get('/course-pass', function () {
  return view('lc/course-pass');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
