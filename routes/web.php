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

Route::get('/',['as'=>'welcome.view','uses'=>'HomeController@welcome']);
Route::get('/toppers',['as'=>'team.toppers','uses'=>'HomeController@toppers']);
Auth::routes();


Route::get('/check', 'HomeController@twilio');
//Testing
Route::get('/testing', 'Auth\LoginController@testing');

Route::get('/checkArray', 'HomeController@checkArray');

//Contact us post route
Route::post('/contact/us', ['as'=>'contact.us','uses'=>'HomeController@contactUsSave']);


Route::post('/phone/verify', ['as'=>'phone.verify','uses'=>'Auth\AuthController@phone_verify']);
Route::post('/authentication/user', ['as'=>'authentication.user','uses'=>'Auth\AuthController@authenticateUser']);
Route::post('/otp/verification', ['as'=>'otp.verification','uses'=>'Auth\AuthController@otpVerification']);


//Admin Route Management
Route::group(['prefix' => 'admin'],function() {

	//profile update
	Route::post('profile/update/{id}',['as'=>'profile.update','uses'=>'Auth\AuthController@update']);

	Route::get('/home', 'AdminController@home');
	Route::get('/profile' ,['as'=>'profile.page','uses'=>'AdminController@Profile']);
	Route::resource('team','AdminController');
	Route::get('change/status/{id}',['as'=>'change.status','uses'=>'AdminController@ChangeStatus']);
	Route::get('top/teams',['as'=>'top.teams','uses'=>'AdminController@TopTeams']);

	//Quiz Team Mapping
	Route::resource('mapping','QuizTeamMapController');
	Route::get('get/ajax/{id}',['as'=>'get.ajax','uses'=>'QuizTeamMapController@getAjax']);
		
	//Student-Team Mapping
	Route::resource('student','StudentController');

	//Role management routes
	Route::resource('role','RoleController');

	//question management routes
	Route::resource('question','QuestionController');
	Route::post('question/post/examination',['as'=>'question.post.examination','uses'=>'QuestionController@examination']);
	Route::post('image/upload',['as'=>'image.upload','uses'=>'QuestionController@ImageUpload']);
	Route::get('question/by_quiz/{id}',['as'=>'question.by_quiz','uses'=>'QuestionController@questionByQuiz']);

	Route::get('/contact', ['as'=>'contact.us','uses'=>'AdminController@contactUs']);
	Route::get('/contact/{id}', ['as'=>'contact.delete','uses'=>'AdminController@deleteContact']);

	//Quiz management routes
	Route::resource('quiz','QuizController');
	Route::get('get/question/{id}',['as'=>'get.question','uses'=>'QuizController@getQuestion']);

});






//Team Management Rutes
Route::group(['prefix' => 'teams'],function() {

//Examination
Route::resource('exam','ExaminationController');
Route::get('exam/by/{id}',['as'=>'exam.byId','uses'=>'ExaminationController@examById']);
Route::get('examCount','ExaminationController@examCount');
Route::get('pagination/fetch_data','ExaminationController@fetch_data');
Route::post('/save/raw', ['as'=>'save.raw','uses'=>'ExaminationController@SaveRaw']);
Route::post('/save/raw/answer', ['as'=>'save.raw.answer','uses'=>'ExaminationController@SaveRawAnswer']);


Route::resource('teams','TeamController');

Route::get('/quizzes',['as'=>'team.quizzes','uses'=>'TeamController@teamResult']);

Route::get('/login', ['as'=>'team.login','uses'=>'TeamLoginController@TeamLoginForm']);
Route::post('/login', ['as'=>'team.login','uses'=>'TeamLoginController@TeamLogin']);
Route::post('/logout', ['as'=>'team.logout','uses'=>'TeamLoginController@logout']);


Route::get('/dashboard', 'TeamController@index')->name('dashboard');
});
