<?php
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
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
  
    return view('welcome');
});


Route::get('/uploadimg', function () {
  
    return view('ischool.uploadimg');
});

Route::post('upladimg', 'PythonController@upladimg');


Route::get('/status', function () {
    return view('showestatus');
});

Route::post('/mgadminschool_term', 'Masteradmin\ManageSchoolController@add_term')->name('add_term');
Route::post('/mgadminschool_add-Newterm', 'Masteradmin\ManageSchoolController@add_Newterm')->name('add-Newterm');

Route::post('/getdata', 'PythonController@getdata')->name('getdata');
Route::post('/test', 'PythonController@store')->name('test');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/term', 'Masteradmin\ManageSchoolController@index_term')->name('index_term');
Route::resource('mgmaseterschool', 'Masteradmin\ManageSchoolController')->names([
    'create' => 'mgmaseterschool.create',
    'store'  => 'mgmaseterschool.store'
]);
Route::resource('mgmaseteruser', 'Masteradmin\ManageUserController')->names([
    'create' => 'mgmaseteruser.create',
    'store'  => 'mgmaseteruser.store'
]);
Route::post('mgmaseteruserde/{id}/{dd}', 'Masteradmin\ManageUserController@destroy');
Route::post('masteradduserexcel', 'Masteradmin\ManageUserController@addexcel');

Route::get('school/{id}', 'Masteradmin\ManageUserController@selectsubsector');
Route::resource('mgmaseterstuden', 'Masteradmin\ManageStudenController')->names([
    'create' => 'mgmaseterstuden.create',
    'store'  => 'mgmaseterstuden.store'
]);
Route::resource('mgmasetergroup', 'Masteradmin\ManageGroupUserController')->names([
    'create' => 'mgmasetergroup.create',
    'store'  => 'mgmasetergroup.store'
]);
Route::resource('mgteacherinfo', 'Teacher\InfoStudentController');
Route::resource('class-schedule-teacher', 'Teacher\ScheduleController');
Route::resource('time-attendance-teacher', 'Teacher\Time_attendanceController');
Route::get('time_attendance_teacherst/{id}/{school}', 'Teacher\Time_attendanceController@show');
Route::get('searchdetil', 'Teacher\Time_attendanceController@search');
Route::get('/public-relations-tc', 'Teacher\ScheduleController@index_public_relations_tc')->name('index_public_relations_tc-tc');
Route::get('/contact-school-tc', 'Teacher\ScheduleController@index_contact_school_tc')->name('index_contact_school_tc');
Route::get('/floor-teacher-tc', 'Parent\ScheduleController@index_floor_teacher_tc')->name('floor-teacher-tc');

Route::get('/role', 'Masteradmin\ManageRoleUserController@index')->name('role');



Route::get('/profile', 'Parent\ParentController@index_addten')->name('profile');
Route::get('/contact-school', 'Parent\ParentController@index_contact')->name('contact-school');
Route::get('/public-relations', 'Parent\ParentController@index_public_relations')->name('public-relations');
Route::get('/report-problems', 'Parent\ParentController@index_report_problem')->name('index_report_problem');
Route::get('/class-schedule', 'Parent\ParentController@index_class_schedule')->name('class_schedule');
Route::get('/floor-teacher', 'Parent\ParentController@index_floor_teacher')->name('floor-teacher');
Route::get('/list', 'Parent\ParentController@index_list_att')->name('list');


//Route::get('/mgadminschool', 'AdminSchool\ManageUserController@index')->name('mgadminschool');
//Route::post('/mgadminschoolsave', 'AdminSchool\ManageUserController@store')->name('mgadminschoolsave');
Route::resource('mgadminschool', 'AdminSchool\ManageUserController');
Route::post('mgadminschool_d/{id}/{dd}', 'AdminSchool\ManageUserController@destroy');










Route::resource('/mgadminnewschool', 'AdminSchool\ManageNewController')->names([
    'create' => 'mgadminnewschool.create',
    'store'  => 'mgadminnewschool.store'
]);

//Clear route cache:
Route::get('/route-Clear-all', function() {

    $exitCode = Artisan::call('config:cache');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('view:clear');
    return 'ok!';
});


