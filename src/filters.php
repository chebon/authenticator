<?php

use Ejimba\Authenticator\Models\User;

Route::filter('authenticator.auth', function()
{
	if (!Authenticator::check())
	{
		if (Request::ajax()) return Response::make('Unauthorized', 401);

		return Redirect::guest(URL::route('authenticator.login'));
	}
});

Route::filter('authenticator.guest', function()
{
	if (Authenticator::check()){
		return Redirect::intended(Config::get('authenticator::users.login_redirect_fallback_uri'))->with('authenticator_warning_alert', Lang::get('authenticator::partials.users.login_warning_msg'));
	}
});