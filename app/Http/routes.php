<?php
use App\Post_Job;
use App\Post_Job_Detail;
// use App\Category;

//----------------------------------------------------------------------//
//Main Route
//----------------------------------------------------------------------//
    //
    // Route::get('/', function () {
    //     return view('index');
    // })->name('main');


    Route::get('/', [
        'uses' => 'MainController@getIndex',
        'as' => 'main'
    ]);

//----------------------------------------------------------------------//
//Part [1] Auth Route
//----------------------------------------------------------------------//
Route::get('/logout', [
    'uses' => 'AuthController@getLogout',
    'as' => 'logout'
]);
Route::get('/register', [
    'uses' => 'AuthController@getRegisterPage',
    'as' => 'register'
]);

Route::post('/register', [
    'uses' => 'AuthController@postRegister',
    'as' => 'register'
]);
Route::get('/login', [
    'uses' => 'AuthController@getLoginPage',
    'as' => 'login'
]);

Route::post('/login', [
    'uses' => 'AuthController@postLogin',
    'as' => 'login'
]);
//------------Forgot Password---------------
Route::get('/forgot-password', [
    'uses' => 'AuthController@getForgot_PasswordPage', //หน้าลืมรหัสผ่าน
    'as' => 'forgot-password'
]);
Route::post('/forgot-password', [
    'uses' => 'AuthController@postForgot_PasswordPage', //ส่งเมล ลืมรหัสผ่าน
    'as' => 'forgot-password'
]);
Route::get('/reset-password/{id?}', [
    'uses' => 'AuthController@getReset_PasswordPage', //cancle
    'as' => 'reset-password'
]);
Route::post('/reset-password/{id?}', [
    'uses' => 'AuthController@postReset_PasswordPage', //เปลี่ยนรหัสผ่านใหม่
    'as' => 'reset-password'
]);
//-----------------------------------------

Route::get('/freelanceregister', [
    'uses' => 'AuthController@getFreelanceRegisterPage',
    'as' => 'freelanceregister'
]);

Route::post('/freelanceregister', [
    'uses' => 'AuthController@postFreelanceRegister',
    'as' => 'freelanceregister'
]);

Route::get('/employerregister', [
    'uses' => 'AuthController@getEmployerRegisterPage',
    'as' => 'employerregister'
]);

Route::post('/employerregister', [
    'uses' => 'AuthController@postEmployerRegister',
    'as' => 'employerregister'
]);

//----------------------------------------------------------------------//
//Part [2] Page Route
//----------------------------------------------------------------------//
    Route::get('/freelancesboard', [
        'uses' => 'MainController@getFreelancesBoardPage', //หน้าบอร์ดฟรีแลนซ์
        'as' => 'freelancesboard',
    ]);

    Route::get('/jobsboard', [
        'uses' => 'MainController@viewJobsBoard', //บอร์ดประกาศงาน
        'as' => 'jobsboard',
    ]);


    Route::get('/postjob', [
        'uses' => 'PostJobController@getPostjobPage', //เรียกหน้าประกาศงาน
        'as' => 'postjob',
        'middleware' => 'roles',
        'roles' => ['Employer']
    ]);

    Route::post('/postjob', [
        'uses' => 'PostJobController@store', //สร้างประกาศงานใหม่
        'as' => 'postjob',
        'middleware' => 'roles',
        'roles' => ['Employer']
    ]);


    Route::get('/jobsboard/{slug?}', [
        'uses' => 'PostJobController@show', //เรียกประกาศงานตามไอดี
        'as' => 'jobsboard/{slug?}',
        'middleware' => 'roles',
        'roles' => ['Employer', 'Freelance','Admin']
    ]);

    Route::get('/jobsboard/{slug?}/edit', [
        'uses' => 'PostJobController@edit', //เรียกหน้าแก้ไขประกาศงานตามไอดี
        'as' => 'jobsboard/{slug?}/edit',
        'middleware' => 'roles',
        'roles' => ['Employer']
    ]);

    Route::post('/jobsboard/{slug?}/update', [
        'uses' => 'PostJobController@update', //แก้ไขงานเรียบร้อยประกาศงานตามไอดลงฐานข้อมูล
        'as' => 'jobsboard/{slug?}/update',
        'middleware' => 'roles',
        'roles' => ['Employer']
    ]);

    // Route::post('/jobsboard/{slug?}/delete', [
    //     'uses' => 'PostJobController@destroy', //ลบงานไม่ได้ใช้
    //     'as' => 'jobsboard/{slug?}/delete',
    //     'middleware' => 'roles',
    //     'roles' => ['Employer']
    // ]);

    Route::get('/account/{id?}/main', [
        'uses' => 'AuthController@getAccountPage', //หน้าโปรไฟล์
        'as' => 'account/{id?}/main',
        'middleware' => 'roles',
        'roles' => ['Employer', 'Freelance']
    ]);

    Route::get('/account/{id?}/co', [
        'uses' => 'AuthController@getAccountPage_Co', //หน้าโปรไฟล์ - ผู้ร่วมงาน
        'as' => 'account/{id?}/co',
        'middleware' => 'roles',
        'roles' => ['Employer', 'Freelance']
    ]);

    Route::get('/account/{id?}/hire', [
        'uses' => 'AuthController@getAccountPage_Hire', //หน้าโปรไฟล์ - งานที่สมัครหรืองานที่ประกาศ
        'as' => 'account/{id?}/hire',
        'middleware' => 'roles',
        'roles' => ['Employer', 'Freelance']
    ]);
    Route::post('/account/{id?}/hire', [
        'uses' => 'ContactController@ContactStatus',
        'as' => 'account/{id?}/hire',
        'middleware' => 'roles',
        'roles' => ['Employer', 'Freelance']
    ]);


    // //test route
    // Route::get('/test','AuthController@getTest');
    // Route::resource('users','AuthController@getUsers');

    Route::get('profile/{id?}', [
        'uses' => 'AuthController@show', //เรียกโปรไฟล์สมาชิก มุมมองคนอื่น
        'as' => 'profile/{id?}',
        'middleware' => 'roles',
        'roles' => ['Employer', 'Freelance','Admin']
    ]);

    Route::post('profile/review','AuthController@reviews'); //ฟังก์ชันรีวิว
    //end test

    Route::get('/editaccount', [
        'uses' => 'MainController@getEditAccountPage', //แก้ไขข้อมูลส่วนตัว
        'as' => 'edit',
        'middleware' => 'roles',
        'roles' => ['Employer', 'Freelance','Admin']
    ]);

    Route::post('/freelanceaccount',array ('as'=>'freelanceaccount','uses' => 'AuthController@updateFreelanceAccount')); //แก้ไขหน้าฟรีแลนซ์
    Route::post('/employeraccount',array ('as'=>'employeraccount','uses' => 'AuthController@updateEmployerAccount')); //แก้ไขหน้าผู้ว่าจ้าง


    Route::post('/jobsboard/{slug?}','PostJobController@newComment'); //คอมเมนต์ประกาศงาน

    Route::get('/jobsboard/{slug?}/status', [
        'uses' => 'PostJobController@status', //เปิด-ปิด ประกาศงาน
        'as' => 'jobsboard/{slug?}/status',
        'middleware' => 'roles',
        'roles' => ['Employer']
    ]);

    Route::get('/jobsboard/{slug?}/apply','ContactController@apply'); //เรียกฟังก์ชันการสมัครงาน
    Route::post('/jobsboard/{slug?}/apply','ContactController@apply');

    Route::get('/jobsboard/{slug?}/status', [
        'uses' => 'AuthController@status', //เปิด-ปิด ประกาศงาน ในหน้าโปรไฟล์
        'as' => 'jobsboard/{slug?}/status',
        'middleware' => 'roles',
        'roles' => ['Employer']
    ]);


    Route::get('search', [
        'uses' => 'MainController@search', //ค้นหาประกาศงาน
        'as' => 'search'
    ]);
    Route::post('search', [
        'uses' => 'MainController@search',
        'as' => 'search'
    ]);

    // ---hire--
    Route::get('hire', [
        'uses' => 'ContactController@hire_freelance', //สนใจจ้างฟรีแลนซ์ ส่งอีเมลไปแจ้ง
        'as' => 'hire',
        'middleware' => 'roles',
        'roles' => ['Employer']
    ]);

    Route::post('hire/{id?}', [
        'uses' => 'ContactController@hire_freelance',
        'as' => 'hire/{id?}',
        'middleware' => 'roles',
        'roles' => ['Employer']
    ]);
    // ---hire--

    Route::get('freelancelist/{slug?}', [
        'uses' => 'ContactController@ContactStatus', //รายชื่อผู้สมัครงาน การรับหรือปฏิเสธ
        'as' => 'freelancelist/{slug?}',
        'middleware' => 'roles',
        'roles' => ['Employer']
    ]);

    Route::post('freelancelist/answer/status', [
        'uses' => 'ContactController@EmpAnswer', //การรับหรือปฏิเสธ
        'as' => 'freelancelist/answer/status',
        'middleware' => 'roles',
        'roles' => ['Employer']
    ]);

    // Route::get('freelancelist/{slug?}','ContactController@ContactStatus'); //รายชื่อผู้สมัครงาน การรับหรือปฏิเสธ
    // Route::post('freelancelist/answer/status','ContactController@EmpAnswer');



    // --------------------ADMIN------------------
    Route::get('admin', [
        'uses' => 'AuthController@getAdminPage', //หน้าหลักแอดมิน
        'as' => 'admin/main',
        'middleware' => 'roles',
        'roles' => ['Admin']
    ]);
    Route::get('admin-ver', [
        'uses' => 'AuthController@getAdminPage_Verify', //หน้าตรวจสอบข้อมูลสมาชิก
        'as' => 'admin/verify',
        'middleware' => 'roles',
        'roles' => ['Admin']
    ]);
    Route::get('admin-ver/{id?}', [
        'uses' => 'AuthController@getAdminPage_Verify_Detail', //หน้ายืนยันข้อมูล
        'as' => 'admin/verify/{id?}',
        'middleware' => 'roles',
        'roles' => ['Admin']
    ]);
    Route::post('admin-ver/{id?}', [
        'uses' => 'AuthController@getAdminPage_Verify_Detail_Answer',
        'as' => 'admin/verify/{id?}',
        'middleware' => 'roles',
        'roles' => ['Admin']
    ]);

    Route::get('admin-edit', [
        'uses' => 'AuthController@getAdminPage_Edit', //แก้ไขหน้าแอดมิน
        'as' => 'admin/edit',
        'middleware' => 'roles',
        'roles' => ['Admin']
    ]);

    Route::post('/admin', [
        'uses' => 'AuthController@updateAdminAccount', //แก้ไขหน้าแอดมินลงฐานข้อมูล
        'as' => 'admin',
        'middleware' => 'roles',
        'roles' => ['Admin']
    ]);



    Route::get('user_identify/{id?}', [
        'uses' => 'AuthController@user_identify', //หน้าอัพโหลดไฟล์ยืนยันตัวตน
        'as' => 'user_identify/{id?}',
        'middleware' => 'roles',
        'roles' => ['Employer', 'Freelance']
    ]);

    Route::post('user_identify/{id?}', [
        'uses' => 'AuthController@user_identify', //หลังอัพโหลดไฟล์ยืนยันตัวตน ไปที่หน้า ตรวจสอบ พร้อม status
        'as' => 'user_identify/{id?}',
        'middleware' => 'roles',
        'roles' => ['Employer', 'Freelance']
    ]);


    // Route::get('user_identify/{id?}','AuthController@user_identify'); //
    // Route::post('user_identify/{id?}','AuthController@user_identify'); //
    // Route::post('/admin',array ('as'=>'admin','uses' => 'AuthController@updateAdminAccount')); //


    // ------------------------------------------

//----------------------------------------------------------------------//
//Part [3] Test Route
//----------------------------------------------------------------------//
  Route::get('sendmail', [
    'uses' => 'MainController@sendmail',
    'as' => 'sendmail',
    'middleware' => 'roles',
    'roles' => ['Employer']
  ]);
