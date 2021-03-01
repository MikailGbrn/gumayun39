<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', 'HomeController@index');

Auth::routes(['verify' => true]);

Route::get('company/login', 'CompanyAdmin\CompanyAuth@showLogin')->name('company.login');
Route::get('company/register', 'CompanyAdmin\CompanyAuth@showRegister');
Route::post('company/login', 'CompanyAdmin\CompanyAuth@Login');
Route::post('company/register', 'CompanyAdmin\CompanyAuth@Register');
Route::get('company/logout', 'CompanyAdmin\CompanyAuth@Logout');
Route::get('company/forgotpw', 'CompanyAdmin\CompanyAuth@showForgetPassword');
Route::post('company/forgotpw', 'CompanyAdmin\CompanyAuth@forgetPassword');



Route::prefix('company-profile')->middleware(['auth:admin-company','subscription'])->group( function(){
    Route::get('/','CompanyAdmin\DashboardCompany@index');
    Route::get('/edit','CompanyAdmin\DashboardCompany@showEditCompany');
    Route::get('/account-setting','CompanyAdmin\DashboardCompany@showEditAccount');
    Route::post('/account-setting/edit','CompanyAdmin\DashboardCompany@EditAccount');
    Route::post('/account-setting/change-password','CompanyAdmin\DashboardCompany@changePassword');
    Route::get('/product/statistic','CompanyAdmin\DashboardCompany@showStatisticProduct');
    Route::get('/media/statistic','CompanyAdmin\DashboardCompany@showStatisticMedia');
    Route::post('/edit','CompanyAdmin\DashboardCompany@editCompany');
    Route::post('/about','CompanyAdmin\DashboardCompany@editAbout');
    Route::get('/download/{id}','CompanyAdmin\DashboardCompany@download');
    

    
    Route::get('/product','CompanyAdmin\ProductCompany@showProduct');
    Route::get('/product/add','CompanyAdmin\ProductCompany@showAddProduct');
    Route::get('/product/{id}','CompanyAdmin\ProductCompany@showEditProduct');
    Route::post('/product/addpic','CompanyAdmin\ProductCompany@addPicture');
    Route::post('/product/delpic','CompanyAdmin\ProductCompany@deletePicture');
    Route::post('/product','CompanyAdmin\ProductCompany@addProduct');
    Route::put('/product','CompanyAdmin\ProductCompany@editProduct');
    Route::delete('/product','CompanyAdmin\ProductCompany@deleteProduct');

    Route::get('/media','CompanyAdmin\MediaCompany@showMedia');
    Route::get('/media/add','CompanyAdmin\MediaCompany@showAddMedia');
    Route::get('/media/{id}','CompanyAdmin\MediaCompany@showEditMedia');
    Route::post('/media','CompanyAdmin\MediaCompany@addMedia');
    Route::put('/media','CompanyAdmin\MediaCompany@editMedia');
    Route::delete('/media','CompanyAdmin\MediaCompany@deleteMedia');

    Route::get('/news','CompanyAdmin\NewsCompany@showNews');
    Route::get('/news/add','CompanyAdmin\NewsCompany@showAddNews');
    Route::get('/news/{id}','CompanyAdmin\NewsCompany@showEditNews');
    Route::post('/news','CompanyAdmin\NewsCompany@addNews');
    Route::put('/news','CompanyAdmin\NewsCompany@editNews');
    Route::delete('/news','CompanyAdmin\NewsCompany@deleteNews');

    Route::get('/project','CompanyAdmin\ProjectCompany@showProject');
    Route::get('/project/add','CompanyAdmin\ProjectCompany@showAddProject');
    Route::get('/project/{id}','CompanyAdmin\ProjectCompany@showEditProject');
    Route::post('/project/addpic','CompanyAdmin\ProjectCompany@addPicture');
    Route::post('/project/delpic','CompanyAdmin\ProjectCompany@deletePicture');
    Route::post('/project','CompanyAdmin\ProjectCompany@addProject');
    Route::put('/project','CompanyAdmin\ProjectCompany@editProject');
    Route::delete('/project','CompanyAdmin\ProjectCompany@deleteProject');
});
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/contact', 'HomeController@contact')->name('contact');

Route::get('/company', 'CompanyController@find')->name('company');
Route::get('/company/{slug}', 'CompanyController@detail');
Route::get('/company/{slug}/media', 'CompanyController@showCompanyMedia');
Route::get('/company/{slug}/product', 'CompanyController@showCompanyProduct');
Route::get('/company/{slug}/news', 'CompanyController@showCompanyNews');
Route::get('/company/{slug}/project', 'CompanyController@showCompanyProject');
Route::get('/company/{slug}/about', 'CompanyController@showCompanyAbout');

Route::get('/project/{CompanyId}/{slug}','ProjectController@detail');
Route::get('/project', 'ProjectController@find')->name('project');
Route::get('/news/{CompanyId}/{slug}','NewsController@detail');
Route::get('/news', 'NewsController@find')->name('news');

Route::get('/product', 'ProductController@find')->name('product');
Route::get('/product/{CompanyId}/{slug}','ProductController@detail');
Route::post('product/addquotation', 'ProductController@addQuotation');

Route::get('/search', 'MediaController@find');
Route::get('/resource/{CompanyId}/{slug}','MediaController@detail');
Route::get('/download-resource/{Uuid}','MediaController@download');


Route::get('/admin-456', 'Admin\AdminLogin@showLogin');
Route::post('/admin-456', 'Admin\AdminLogin@login');


Route::prefix('administrator')->middleware('mimin')->group( function(){
    Route::get('/logout', 'Admin\AdminLogin@logout');

    Route::get('/dashboard','Admin\DashboardAdmin@showDashboard');

    Route::get('/company','Admin\CompanyAdmin@showCompany');
    Route::put('/company','Admin\CompanyAdmin@activate');
    // Route::get('/activate','Admin\CompanyAdmin@sendMail');

    Route::get('/subscription','Admin\SubscriptionAdmin@showSubscription');
    Route::put('/subscription','Admin\SubscriptionAdmin@updateSubscription');

    Route::get('/user','Admin\UserAdmin@showUser');

    Route::get('/product','Admin\ContentAdmin@showProduct');
    Route::put('/product','Admin\ContentAdmin@takedownProduct');
    Route::get('/media','Admin\ContentAdmin@showMedia');
    Route::put('/media','Admin\ContentAdmin@takedownMedia');
    Route::get('/news','Admin\ContentAdmin@showNews');
    Route::put('/news','Admin\ContentAdmin@takedownNews');
    Route::get('/project','Admin\ContentAdmin@showProject');
    Route::put('/project','Admin\ContentAdmin@takedownProject');

    Route::get('/banner','Admin\BannerAdmin@showBanner');
    Route::post('/banner','Admin\BannerAdmin@addBanner');
    Route::put('/banner','Admin\BannerAdmin@editBanner');
    Route::delete('/banner','Admin\BannerAdmin@deleteBanner');
    
});

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});

Route::get('send-maill', function () {
    $data = [
        'companyName' => "PT. DAHANA",
        'email' =>"m.arkanmufadho@gmail.com",
        'password' => "88342232"
    ];
   
    \Mail::to('m.arkanmufadho@gmail.com')->send(new \App\Mail\MailRegistcompany($data));
   
    dd("Email is Sent.");
});