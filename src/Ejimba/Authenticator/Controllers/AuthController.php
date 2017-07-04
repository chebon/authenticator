<?php

namespace Ejimba\Authenticator\Controllers;

use View, Input, Redirect, Auth, Config, Lang, Authenticator, Validator;

class AuthController extends BaseController {

    /**
    * 
    * Displays the login form
    * 
    **/

    public function login()
    {
        return View::make(Config::get('authenticator::views.login'));
    }

    /**
    * 
    * Perform login process
    * 
    **/

    public function do_login()
    {

        $input = array_except(Input::all(), '_token');

        $login_rules = array(
            'email' => 'required|email',
            'password' => 'required'
        );

        $validation = Validator::make($input, $login_rules);

        if ($validation->passes())
        {
            $credentials = $input;

            if (Authenticator::authenticate($credentials))
            {
                return Redirect::intended(Config::get('authenticator::users.login_redirect_fallback_uri'))->with('authenticator_success_alert', Lang::get('authenticator::partials.users.login_success_msg'));
            }

            return Redirect::action('Ejimba\Authenticator\Controllers\AuthController@login')->withInput()->with('authenticator_danger_alert', Lang::get('authenticator::partials.users.login_error_msg'));
        }
        return Redirect::action('Ejimba\Authenticator\Controllers\AuthController@login')
            ->withInput()
            ->withErrors($validation)
            ->with('authenticator_danger_alert', Lang::get('authenticator::partials.users.validation_error_msg'));
    }

    /**
    * 
    * Displays the forgot form
    * 
    **/

    public function forgot()
    {
        if(Config::get('authenticator::users.password_reset_allowed')){
            return View::make(Config::get('authenticator::views.forgot'));
        }
        else{
            return View::make(Config::get('authenticator::views.contact_system_admin'));
        }
        
    }

    /**
    * 
    * Perform forgot process
    * 
    **/

    public function do_forgot()
    {
        if(!Config::get('authenticator::users.password_reset_allowed')){
            return View::make(Config::get('authenticator::views.contact_system_admin'));
        }

        $input = array_except(Input::all(), '_token');

        $forgot_rules = array(
            'email' => 'required|email'
        );

        $validation = Validator::make($input, $forgot_rules);

        if ($validation->passes())
        {
            $user = Authenticator::findUserByLogin(Input::get('email'));

            if(!is_null($user)){
                Authenticator::reset($user);
            }
        
            return Redirect::action('Ejimba\Authenticator\Controllers\AuthController@login')->with('authenticator_success_alert', Lang::get('authenticator::partials.users.forgot_success_msg'));
        }

        return Redirect::action('Ejimba\Authenticator\Controllers\AuthController@forgot')
            ->withInput()
            ->withErrors($validation)
            ->with('authenticator_danger_alert', Lang::get('authenticator::partials.users.validation_error_msg'));

    }

    /**
    * 
    * Displays the reset form
    * 
    **/

    public function reset($password_reset_code)
    {
        $user = Authenticator::findUserByPasswordResetCode($password_reset_code);
        if(is_null($user)){
            return Redirect::action('Ejimba\Authenticator\Controllers\AuthController@forgot')->with('authenticator_danger_alert', Lang::get('authenticator::partials.users.reset_error_msg'));
        }
        return View::make(Config::get('authenticator::views.reset'), compact('password_reset_code'));
    }

    /**
    * 
    * Perform reset process
    * 
    **/

    public function do_reset()
    {
        $input = array_except(Input::all(), '_token');

        $reset_rules = array(
            'password' => 'required|min:8',
            'password_confirmation' => 'required|min:8|same:password'
        );

        $validation = Validator::make($input, $reset_rules);

        if ($validation->passes())
        {
            if(!Input::has('password_reset_code')){
                return Redirect::action('Ejimba\Authenticator\Controllers\AuthController@reset', array('password_reset_code' => ''))
                    ->with('authenticator_danger_alert', Lang::get('authenticator::partials.users.reset_error_msg'));
            }

            $password_reset_code = $input['password_reset_code'];
            $new_password = $input['password'];

            $user = Authenticator::findUserByPasswordResetCode($password_reset_code);

            if(is_null($user)){
                return Redirect::action('Ejimba\Authenticator\Controllers\AuthController@reset', array('password_reset_code' => $password_reset_code))
                    ->with('authenticator_danger_alert', Lang::get('authenticator::partials.users.reset_error_msg'));
            }

            if(!$user->attemptResetPassword($password_reset_code, $new_password)){
                return Redirect::action('Ejimba\Authenticator\Controllers\AuthController@reset', array('password_reset_code' => $password_reset_code))
                    ->with('authenticator_danger_alert', Lang::get('authenticator::partials.users.reset_error_msg'));
            }

            return Redirect::action('Ejimba\Authenticator\Controllers\AuthController@login')->with('authenticator_success_alert', Lang::get('authenticator::partials.users.reset_success_msg'));
        }

        return Redirect::action('Ejimba\Authenticator\Controllers\AuthController@reset', array('password_reset_code' => Input::get('password_reset_code')))
            ->withInput()
            ->withErrors($validation)
            ->with('authenticator_danger_alert', Lang::get('authenticator::partials.users.validation_error_msg'));

    }


    /**
    * 
    * Displays the register form
    * 
    **/

    public function register()
    {
        if(Config::get('authenticator::users.registration_allowed')){
            return View::make(Config::get('authenticator::views.register'));
        }
        else{
            return View::make(Config::get('authenticator::views.contact_system_admin'));
        }
    }

    /**
    * 
    * Perform register process
    * 
    **/

    public function do_register()
    {
        $input = array_except(Input::all(), '_token');

        $users_table = Config::get('authenticator::prefix', '').'users';
        
        $register_rules = array(
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required|min:3|unique:'.$users_table,
            'email' => 'required|email|unique:'.$users_table,
            'password' => 'required|min:8',
            'password_confirmation' => 'required|min:8|same:password'
        );

        $validation = Validator::make($input, $register_rules);

        if ($validation->passes())
        {
            unset($input['password_confirmation']);

            $user = Authenticator::register($input);

            if(is_null($user)){
                return Redirect::action('Ejimba\Authenticator\Controllers\AuthController@register')
                    ->with('authenticator_danger_alert', Lang::get('authenticator::partials.users.register_error_msg'));
            }

            return Redirect::action('Ejimba\Authenticator\Controllers\AuthController@login')->with('authenticator_success_alert', Lang::get('authenticator::partials.users.register_success_msg'));
        }

        return Redirect::action('Ejimba\Authenticator\Controllers\AuthController@register')
            ->withInput()
            ->withErrors($validation)
            ->with('authenticator_danger_alert', Lang::get('authenticator::partials.users.validation_error_msg'));

    }

    /**
    * 
    * Activates a user account
    * 
    **/

    public function activate($activation_code)
    {
        if(Authenticator::activate($activation_code)){
            return Redirect::action('Ejimba\Authenticator\Controllers\AuthController@login')->with('authenticator_success_alert', Lang::get('authenticator::partials.users.activation_success_msg'));
        }
        return Redirect::action('Ejimba\Authenticator\Controllers\AuthController@login')
            ->with('authenticator_danger_alert', Lang::get('authenticator::partials.users.activation_error_msg'));
    }


    /**
    * 
    * Logs the logged in user out
    * 
    **/

    public function logout()
    {
        Authenticator::logout();
        return Redirect::to(Config::get('authenticator::users.logout_redirect_uri'))->with('authenticator_success_alert', Lang::get('authenticator::users.logout_success_msg'));
    }

}
