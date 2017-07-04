<?php

$authenticatorControllers = 'Ejimba\Authenticator\Controllers\\';

Route::group(Config::get('authenticator::routing'), function() use ($authenticatorControllers)
{
	Route::get('register', array('uses' => $authenticatorControllers.'AuthController@register', 'as' => 'authenticator.register'));
    Route::post('register', array('uses' => $authenticatorControllers.'AuthController@do_register', 'as' => 'authenticator.register'));

    Route::get('login', array('uses' => $authenticatorControllers.'AuthController@login', 'as' => 'authenticator.login', 'before' => 'authenticator.guest'));
    Route::post('login', array('uses' => $authenticatorControllers.'AuthController@do_login', 'as' => 'authenticator.login'));

    Route::get('forgot', array('uses' => $authenticatorControllers.'AuthController@forgot', 'as' => 'authenticator.forgot'));
    Route::post('forgot', array('uses' => $authenticatorControllers.'AuthController@do_forgot', 'as' => 'authenticator.forgot'));

    Route::get('reset/{password_reset_code}', array('uses' => $authenticatorControllers.'AuthController@reset', 'as' => 'authenticator.reset'));
    Route::post('reset', array('uses' => $authenticatorControllers.'AuthController@do_reset', 'as' => 'authenticator.reset'));

    Route::get('activate/{activation_code}', array('uses' => $authenticatorControllers.'AuthController@activate', 'as' => 'authenticator.activate'));
    
    Route::get('settings', array('uses' => $authenticatorControllers.'SettingsController@index', 'as' => 'authenticator.settings'));

    Route::get('users/{id}/edit', array('uses' => $authenticatorControllers.'UserController@edit', 'as' => 'authenticator.users.edit'));
    Route::get('users/{id}/activate', array('uses' => $authenticatorControllers.'UserController@activate', 'as' => 'authenticator.users.activate'));
    Route::get('users/{id}/deactivate', array('uses' => $authenticatorControllers.'UserController@deactivate', 'as' => 'authenticator.users.deactivate'));
    
    Route::get('logout', array('uses' => $authenticatorControllers.'AuthController@logout', 'as' => 'authenticator.logout'));

});

