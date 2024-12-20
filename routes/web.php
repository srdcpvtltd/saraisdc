<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CountryDropdownController;
use App\Http\Controllers\ModualController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\LoginSecurityController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CriminalsController;
use Illuminate\Support\Facades\Artisan;

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
Route::get('dropdown', [CountryDropdownController::class, 'view'])->name('dropdownView')->middleware(['auth','XSS','2fa',]);
Route::get('get-states', [CountryDropdownController::class, 'getStates'])->name('getStates')->middleware(['auth','XSS','2fa',]);
Route::get('get-cities', [CountryDropdownController::class, 'getCities'])->name('getCities')->middleware(['auth','XSS','2fa',]);
Route::get('get-guest-details/', [GuestController::class, 'getGuestDetail'])->name('getGuestDetail')->middleware(['auth','XSS','2fa',]);


Route::get('/', [FrontEndController::class, 'index']);
Auth::routes();
//Route::get('/verifyemail/{token}', 'Auth\RegisterController@verify');
Route::get('/verifyemail/{token}', [\App\Http\Controllers\Auth\RegisterController::class, 'verify']);
Route::get('/add-hotel', [HotelController::class, 'add_hotel'])->name('add-hotel');
Route::post('/add-hotel', [HotelController::class, 'post_add_hotel'])->name('post-add-hotel');
Route::get('/edit-hotel/{hotel_id}', [HotelController::class, 'post_edit_hotel'])->name('post-edit-hotel');
Route::post('/update_edit_hotel', [HotelController::class, 'update_edit_hotel'])->name('post-update-hotel');

Route::get('/get-police-stations', [HotelController::class, 'get_police_stations'])->name('get-police-station');
Route::get('/dashboard', [HomeController::class, 'index'])->name('home')->middleware(['verified', 'auth','XSS','2fa']);

Route::post('/chart', [HomeController::class, 'chart'])->name('get.chart.data')->middleware(['auth','XSS',]);

Route::get('notification', [HomeController::class,'notification']);

// Guest
Route::get('/guest/create', [GuestController::class, 'index'])->name('guest.create')->middleware(['auth','XSS','2fa',]);
Route::post('/guest/store', [GuestController::class, 'store'])->name('guest.store')->middleware(['auth','XSS','2fa',]);
Route::get('/guest/list', [GuestController::class, 'checkoutList'])->name('guest.list')->middleware(['auth','XSS','2fa',]);
Route::get('/guest/detail/{booking_id}', [GuestController::class, 'show'])->name('guest.show')->middleware(['auth','XSS','2fa',]);
Route::get('/mark/suspicious/{booking_id}', [GuestController::class, 'mark_suspicious'])->name('guest.mark_suspicious')->middleware(['auth','XSS','2fa',]);
Route::get('/mark/unsuspicious/{booking_id}', [GuestController::class, 'mark_unsuspicious'])->name('guest.mark_unsuspicious')->middleware(['auth','XSS','2fa',]);
Route::get('/guest/checkout/{booking_id}/room/{room_id}', [GuestController::class, 'checkOut'])->name('guest.checkout')->middleware(['auth','XSS','2fa',]);
Route::get('/guest/filter', [GuestController::class, 'guestFilter'])->name('guest.filter')->middleware(['auth','XSS','2fa',]);
Route::get('/guest/quickinvoice/{id}', [GuestController::class, 'quickinvoice'])->name('guest.quickinvoice')->middleware(['auth','XSS','2fa',]);
Route::get('/guest/pdfquickinvoice/{id}', [GuestController::class, 'pdfquickinvoice'])->name('guest.pdfquickinvoice')->middleware(['auth','XSS','2fa',]);
Route::get('/booking/delete/{booking_id}', [GuestController::class, 'bookingDelete'])->name('booking.delete')->middleware(['auth','XSS','2fa',]);

Route::get('/guest/report', [\App\Http\Controllers\ReportController::class, 'index'])->name('guest.report')->middleware(['auth','XSS','2fa',]);
Route::get('/guest/queries', [\App\Http\Controllers\ReportController::class, 'guest_queries'])->name('guest.queries')->middleware(['auth','XSS','2fa',]);
Route::get('/guest/create/query', [\App\Http\Controllers\ReportController::class, 'create_query'])->name('guest.create.query')->middleware(['auth','XSS','2fa',]);
Route::post('/guest/store/query', [\App\Http\Controllers\ReportController::class, 'store_query'])->name('guest.store.query')->middleware(['auth','XSS','2fa',]);
Route::get('/guest/report/export', [\App\Http\Controllers\ReportController::class, 'export'])->name('guest.report.export')->middleware(['auth','XSS','2fa',]);

Route::get('/admin/report', [\App\Http\Controllers\ReportController::class, 'adminindex'])->name('admin.report')->middleware(['auth','XSS','2fa',]);
Route::get('/admin/irregular_checkin', [\App\Http\Controllers\ReportController::class, 'irregular_checkin'])->name('admin.irregular_checkin')->middleware(['auth','XSS','2fa',]);
Route::get('/admin/suspicious_checkins', [\App\Http\Controllers\ReportController::class, 'suspicious_checkins'])->name('admin.suspicious_checkins')->middleware(['auth','XSS','2fa',]);
Route::get('/messages', [\App\Http\Controllers\ReportController::class, 'messages'])->name('messages')->middleware(['auth','XSS','2fa',]);
Route::get('/admin/queries', [\App\Http\Controllers\ReportController::class, 'queries'])->name('admin.queries')->middleware(['auth','XSS','2fa',]);
Route::get('/admin/resolve/{id}', [\App\Http\Controllers\ReportController::class, 'resolve_query'])->name('admin.resolve_query')->middleware(['auth','XSS','2fa',]);
Route::get('/admin/create/message', [\App\Http\Controllers\ReportController::class, 'create_message'])->name('admin.create.message')->middleware(['auth','XSS','2fa',]);
Route::post('/admin/store/message', [\App\Http\Controllers\ReportController::class, 'store_message'])->name('admin.message.store')->middleware(['auth','XSS','2fa',]);
Route::get('/admin/report/export', [\App\Http\Controllers\ReportController::class, 'adminexport'])->name('admin.post.report')->middleware(['auth','XSS','2fa',]);

Route::get('/admin/hotel_report', [\App\Http\Controllers\ReportController::class, 'hotel_report'])->name('hotel_report.report')->middleware(['auth','XSS','2fa',]);
Route::get('/admin/hotel_report/export', [\App\Http\Controllers\ReportController::class, 'hotel_reportexport'])->name('admin.hotel_report.report')->middleware(['auth','XSS','2fa',]);

Route::get('/admin/viewer_report', [\App\Http\Controllers\ReportController::class, 'viewer_report'])->name('viewer_report.report')->middleware(['auth','XSS','2fa',]);
Route::get('/admin/viewer_report/export', [\App\Http\Controllers\ReportController::class, 'viewer_reportexport'])->name('admin.viewer_report.report')->middleware(['auth','XSS','2fa',]);

Route::get('admin/hotel/detail/{hotel_id}', [HotelController::class, 'show'])->name('post-view-hotel');
Route::get('admin/hotel/update/{hotel_id}', [HotelController::class, 'admin_edit_hotel'])->name('post-edit-hotel');
Route::get('admin/hotel/delete/{hotel_id}', [HotelController::class, 'destory'])->name('post-removed-hotel');
Route::post('/admin_update_hotel', [HotelController::class, 'admin_update_hotel'])->name('admin-update-hotel');

Route::get('/admin/guest/detail/{booking_id}', [GuestController::class, 'adminshow'])->name('admin.guest.show')->middleware(['auth','XSS','2fa',]);
Route::get('/dashboardapi/invalid_users',function(){
    $cubes = new App\Services\Dashboard\InvalidUsers();
    return response()->json(['status' => 'success','html' => $cubes->handleResponce()]);
});
Route::get('/all_wnotification',[HomeController::class, 'all_notification']);

//Route::get('/admin/notification_settings', [NoticationController::class, 'index'])->name('admin.notification_settings')->middleware(['auth','XSS','2fa',]);


Route::group(['middleware' => ['auth','XSS']], function ()
{
    Route::resource('roles',RoleController::class);
    Route::resource('users',UserController::class);
    Route::resource('permission',PermissionController::class);
    Route::resource('modules',ModualController::class);
    Route::resource('notificationsettings',NotificationController::class);
    Route::resource('countries',CountryController::class);
    Route::resource('states',StateController::class);
    Route::resource('cities',CityController::class);
    Route::resource('criminals',CriminalsController::class);


});

Route::delete('/user/{id}', [UserController::class,'destroy'])->name('users.destroy')->middleware(['auth','XSS']);

Route::post('/role/{id}',[RoleController::class,'assignPermission'])->name('roles_permit')->middleware(['auth','XSS']);

Route::group(['middleware' => ['auth','XSS']], function ()
{
        Route::get('setting/email-setting',[SettingController::class,'getmail'])->name('settings.getmail');
        Route::post('setting/email-settings_store',[SettingController::class,'saveEmailSettings'])->name('settings.emails');

        Route::get('setting/datetime',[SettingController::class,'getdate'])->name('datetime');
        Route::post('setting/datetime-settings_store',[SettingController::class,'saveSystemSettings'])->name('settings.datetime');

        Route::get('setting/logo',[SettingController::class,'getlogo'])->name('getlogo');
        Route::post('setting/logo_store',[SettingController::class,'store'])->name('settings.logo');
        Route::resource('settings',SettingController::class);

        Route::get('test-mail', [SettingController::class,'testMail'])->name('test.mail');
        Route::post('test-mail', [SettingController::class,'testSendMail'])->name('test.send.mail');
}
);

Route::get('profile', [UserController::class,'profile'])->name('profile')->middleware(['auth','XSS']);

Route::post('edit-profile', [UserController::class,'editprofile'])->name('update.profile')->middleware(['auth','XSS']);

Route::group(['middleware' => ['auth','XSS']], function ()
{
    Route::get('change-language/{lang}', [LanguageController::class,'changeLanquage'])->name('change.language');
    Route::get('manage-language/{lang}', [LanguageController::class,'manageLanguage'])->name('manage.language');
    Route::post('store-language-data/{lang}', [LanguageController::class,'storeLanguageData'])->name('store.language.data');
    Route::get('create-language', [LanguageController::class,'createLanguage'])->name('create.language');
    Route::post('store-language', [LanguageController::class,'storeLanguage'])->name('store.language');
    Route::delete('/lang/{lang}', [LanguageController::class,'destroyLang'])->name('lang.destroy');
    Route::get('language',[LanguageController::class,'index'])->name('index');
}
);

Route::get('generator_builder', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@builder')->name('io_generator_builder')->middleware(['auth','XSS',]);

Route::get('field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@fieldTemplate')->name('io_field_template')->middleware(['auth','XSS',]);

Route::get('relation_field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@relationFieldTemplate')->name('io_relation_field_template')->middleware(['auth','XSS',]);

Route::post('generator_builder/generate', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generate')->name('io_generator_builder_generate')->middleware(['auth','XSS',]);

Route::post('generator_builder/rollback', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@rollback')->name('io_generator_builder_rollback')->middleware(['auth','XSS',]);

Route::post(
    'generator_builder/generate-from-file',
    '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generateFromFile'
)->name('io_generator_builder_generate_from_file')->middleware(['auth','XSS',]);

Route::group(['prefix'=>'2fa'], function(){
    Route::get('/',[UserController::class,'profile'])->name('2fa')->middleware(['auth','XSS',]);
    Route::post('/generateSecret',[LoginSecurityController::class,'generate2faSecret'])->name('generate2faSecret')->middleware(['auth','XSS',]);
    Route::post('/enable2fa',[LoginSecurityController::class,'enable2fa'])->name('enable2fa')->middleware(['auth','XSS',]);
    Route::post('/disable2fa',[LoginSecurityController::class,'disable2fa'])->name('disable2fa')->middleware(['auth','XSS',]);

    // 2fa middleware
    Route::post('/2faVerify', function () {
        return redirect(URL()->previous());
    })->name('2faVerify')->middleware('2fa');
});


Route::get('/changePassword', [App\Http\Controllers\HomeController::class, 'showChangePasswordGet'])->name('changePasswordGet');
Route::post('/changePassword', [App\Http\Controllers\HomeController::class, 'changePasswordPost'])->name('changePasswordPost');

Route::group(['middleware' => 'auth'], function() {
    Route::get('/changePassword',[App\Http\Controllers\HomeController::class, 'showChangePasswordGet'])->name('changePasswordGet');
    Route::post('/changePassword',[App\Http\Controllers\HomeController::class, 'changePasswordPost'])->name('changePasswordPost');
});


Route::resource('tests', App\Http\Controllers\TestController::class)->middleware(['auth','XSS']);
