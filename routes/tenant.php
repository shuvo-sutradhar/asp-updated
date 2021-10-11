<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;



/**************************
***  Global Api route  ***
**************************/ 
Route::prefix('api')->middleware([
    'api',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    // general settings
    Route::get('system-settings', 'API\GeneralSettingController@index');
});



/**************************
***  Guest Api route ***
**************************/ 
Route::prefix('api')->middleware([
    'guest:api',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::post('/login', 'Auth\LoginController@login');
    Route::post('/register', 'Auth\RegisterController@register');
    Route::get('/test', function(){
        return response()->json(tenant('id'));
    });
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');

    Route::post('email/verify/{user}', 'Auth\VerificationController@verify');
    Route::post('email/resend', 'Auth\VerificationController@resend');

    Route::post('oauth/{driver}', 'Auth\OAuthController@redirectToProvider');
    Route::get('oauth/{driver}/callback', 'Auth\OAuthController@handleProviderCallback');
});


/**************************
***  Auth Api route ***
**************************/ 
Route::prefix('api')->middleware([
    'auth:api',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::post('logout', 'Auth\LoginController@logout');
    Route::get('/user', 'Auth\UserController@current');
    Route::patch('settings/profile', 'Settings\ProfileController@update');
    Route::patch('settings/password', 'Settings\PasswordController@update');   
    
    /*
    *   Team Controller
    */
    Route::apiResource('team', 'API\TeamController');
    Route::post('team/delete_teams', 'API\TeamController@delete_teams');
    Route::get('/team-search/{query}', 'API\TeamController@search');
    Route::get('/service-teams', 'API\TeamController@serviceTeam');
    
    /*
    *   Tag Controller
    */
    Route::apiResource('tag', 'API\TagController');
    Route::post('tag/delete_tags', 'API\TagController@delete_tags');
    Route::get('/tag-search/{query}', 'API\TagController@search');
    Route::get('/service-tags', 'API\TagController@serviceTags');
    
    /*
    *   Role and permission Controller
    */
    Route::apiResource('permission', 'API\PermissionController');
    Route::apiResource('role', 'API\RoleController');

    /*
    *   Tag Controller
    */
    Route::get('activity-log', 'API\ActivityLogController@index');
    Route::delete('activaty-log/{id}', 'API\ActivityLogController@destroy');
    Route::get('activaty-log-clear', 'API\ActivityLogController@clear');

    /*
    *  Order Setting
    */
    Route::apiResource('order-settings', 'API\OrderSettingsController');

    /*
    *  Service Controller
    */
    Route::apiResource('/service', 'API\ServiceController');
    Route::get('/service-search/{query}', 'API\ServiceController@search');
    Route::post('serviceValidation', 'API\ServiceController@validateName');
    Route::post('/service/delete-services', 'API\ServiceController@deleteServices');
});



/**************************
     ***   Default ***
**************************/ 
Route::middleware([
    'api',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    // TenentController
    Route::get('{path}', 'WelcomeController')->where('path', '(.*)');
});
