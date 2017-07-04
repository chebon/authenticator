<?php

namespace Ejimba\Authenticator;

use View, Auth, URL, Mail, Sentry, Config;
use Ejimba\Authenticator\Models\Group;
use Ejimba\Authenticator\Models\User;

class Authenticator {

    protected $error;

    /**
     *  Display the login form
     */
    
    public function displayLoginForm()
    {
        return View::make('authenticator::partials.users.login');
    }

    /**
     *  Display the forgot form
     */
    
    public function displayForgotForm()
    {
        return View::make('authenticator::partials.users.forgot');
    }

    /**
     *  Display the reset form
     */
    
    public function displayResetForm($password_reset_code)
    {
        return View::make('authenticator::partials.users.reset', compact('password_reset_code'));
    }

    /**
     *  Display the register form
     */
    
    public function displayRegisterForm()
    {
        return View::make('authenticator::partials.users.register');
    }

    /**
     *  Display the user settings form
     */
    
    public function displayUsersSettings()
    {
        $users = $this->findAllUsers();
        return View::make('authenticator::partials.settings.users', compact('users'));
    }

    /**
     *  Display the group settings form
     */
    
    public function displayGroupsSettings()
    {
        $groups = $this->findAllGroups();
        return View::make('authenticator::partials.settings.groups', compact('groups'));
    }

    
    /**
     *  Display the general contact system admin form
     */
    
    public function displayContactSystemAdminForm()
    {
        return View::make('authenticator::partials.users.error');
    }

    public function user(){
        return Sentry::getUser();
    }

    public function authenticate($credentials, $remember = false)
    {
        try
        {
            Sentry::authenticate($credentials, $remember);
            return true;
        }
        catch (\Cartalyst\Sentry\Users\LoginRequiredException $e)
        {
            $this->error = 'Login field is required.';
            return false;
        }
        catch (\Cartalyst\Sentry\Users\PasswordRequiredException $e)
        {
            $this->error = 'Password field is required.';
            return false;
        }
        catch (\Cartalyst\Sentry\Users\WrongPasswordException $e) 
        {
            $this->error = 'Wrong password, try again.';
            return false;
        }
        catch (\Cartalyst\Sentry\Users\UserNotFoundException $e) 
        {
            $this->error = 'User was not found.';
            return false;
        }
        catch (\Cartalyst\Sentry\Users\UserNotActivatedException $e) 
        {
            $this->error = 'User is not activated.';
            return false;
        }
        // The following is only required if the throttling is enabled
        catch (\Cartalyst\Sentry\Throttling\UserSuspendedException $e)
        {
            $this->error =  'User is suspended.';
            return false;
        }
        catch (\Cartalyst\Sentry\Throttling\UserBannedException $e)
        {
            $this->error =  'User is banned.';
            return false;
        }
        return false;
    }

    public function login($user, $remember = false)
    {
        try
        {
            Sentry::login($user, $remember);
            return true;
        }
        catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
        {
            $this->error = 'Login field is required.';
            return false;
        }
        catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            $this->error = 'User not found.';
            return false;
        }
        catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
        {
            $this->error = 'User not activated.';
            return false;
        }
        catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e)
        {
            $time = $throttle->getSuspensionTime();
            $this->error = "User is suspended for [$time] minutes.";
            return false;
        }
        catch (Cartalyst\Sentry\Throttling\UserBannedException $e)
        {
            $this->error = 'User is banned.';
            return false;
        }
    }

    /**
     *  Register a new user
     */

    public function createUser(array $credentials)
    {
        try
        {
            $user = Sentry::createUser($credentials);
            return $user;
        }
        catch (\Cartalyst\Sentry\Users\LoginRequiredException $e)
        {
            $this->error = 'Login field is required.';
        }
        catch (\Cartalyst\Sentry\Users\PasswordRequiredException $e)
        {
            $this->error = 'Password field is required.';
        }
        catch (\Cartalyst\Sentry\Users\UserExistsException $e)
        {
            $this->error = 'User with this login already exists.';
        }
        return null;
    }

    /**
     *  Register a new group
     */

    public function createGroup(array $attributes)
    {
        try
        {
            $group = Sentry::createGroup($attributes);
            return $group;
        }
        catch (\Cartalyst\Sentry\Groups\NameRequiredException $e)
        {
            $this->error =  'Name field is required';
        }
        catch (\Cartalyst\Sentry\Groups\GroupExistsException $e)
        {
            $this->error =  'Group already exists';
        }
        return null;
    }

    /**
     *  Register a new user
     */

    public function register(array $credentials, $activate = false)
    {
        $require_email_activation = Config::get('authenticator::users.activation');
        $registration_allowed = Config::get('authenticator::users.registration_allowed');

        if($registration_allowed)
        {
            try
            {
                if(!$require_email_activation)
                {
                    $activate = true;
                }
                // Let's register a user.
                $user = Sentry::register($credentials, $activate);

                // Send activation code to the user so he can activate the account
                if(!$activate)
                {
                    $activation_url = action('Ejimba\Authenticator\Controllers\AuthController@activate', array($user->getActivationCode()));

                    $data = array(
                            'activation_url' => $activation_url,
                            'email' => $user->email,
                            'first_name' => $user->first_name,
                            'last_name' => $user->last_name,
                            'subject' => 'Account Activation',
                    );

                    //Send this code to your user via email

                    Mail::queue(Config::get('authenticator::views.account_activation_email'), $data, function($message) use($data)
                    {
                        $message->to($data['email'])->subject($data['subject']);
                    });
                }

                return $user;
            }
            catch (\Cartalyst\Sentry\Users\LoginRequiredException $e)
            {
                $this->error = 'Login field is required.';
            }
            catch (\Cartalyst\Sentry\Users\PasswordRequiredException $e)
            {
                $this->error = 'Password field is required.';
            }
            catch (\Cartalyst\Sentry\Users\UserExistsException $e)
            {
                $this->error = 'User with this login already exists.';
            }
        }
        else{
            $this->error = 'Public Registration is not allowed.';
        }
        return null;
    }

     /**
     *  Reset a user's password
     */

    public function reset($user){
        // Get the password reset code

        $password_reset_url = action('Ejimba\Authenticator\Controllers\AuthController@reset', array($user->getResetPasswordCode()));

        $data = array(
                    'password_reset_url' => $password_reset_url,
                    'email' => $user->email,
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'subject' => 'Password Reset',
        );

        //Send this code to your user via email

        Mail::queue(Config::get('authenticator::views.reset_password_email'), $data, function($message) use($data)
        {
            $message->to($data['email'])->subject($data['subject']);
        });
    }
    
    /**
     *  Find all users
     */
    
    public function findAllUsers(){
        return Sentry::findAllUsers();
    }

    /**
     *  Find a user by id
     */
    
    public function findUserById($id){
        
        try
        {
            $user = Sentry::findUserById($id);
            return $user;
        }
        catch (\Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            $this->error = 'User was not found.';
            return null;
        }
    }

    /**
     *  Find a user by login
     */
    
    public function findUserByLogin($login){
        
        try
        {
            $user = Sentry::findUserByLogin($login);
            return $user;
        }
        catch (\Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            $this->error = 'User was not found.';
            return null;
        }
    }

    /**
     *  Find a user by password_reset_code
     */
    
    public function findUserByPasswordResetCode($password_reset_code){
        try
        {
            $user = Sentry::findUserByResetPasswordCode($password_reset_code);
            return $user;
        }
        catch (\Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            $this->error = 'User was not found.';
            return null;
        }
    }


    /**
     *  Find a user by activation_code
     */
    
    public function findUserByActivationCode($activation_code){
        
        try
        {
            $user = Sentry::findUserByActivationCode($activation_code);
            return $user;
        }
        catch (\Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            $this->error = 'User was not found.';
            return null;
        }
    }

    /**
     *  Find all groups
     */
    
    public function findAllGroups(){
        return Sentry::findAllGroups();
    }

    /**
     *  Find a group by id
     */
    
    public function findGroupById($id){
        
        try
        {
            $group = Sentry::findGroupById($id);
            return $group;
        }
        catch (\Cartalyst\Sentry\Groups\GroupNotFoundException $e)
        {
            $this->error = 'Group was not found.';
            return null;
        }
    }

    /**
     *  Find a group by name
     */
    
    public function findGroupByName($name){
        
        try
        {
            $group = Sentry::findGroupByName($name);
            return $group;
        }
        catch (\Cartalyst\Sentry\Groups\GroupNotFoundException $e)
        {
            $this->error = 'Group was not found.';
            return null;
        }
    }



    /**
     *  Activate user by activation code
     */
    
    public function activate($activation_code)
    {
        $user = $this->findUserByActivationCode($activation_code);
        
        if(!is_null($user)){
            if($user->attemptActivation($activation_code)){
                return true;
            }
        }
        return false;
    }

    /**
     *  Log out a user
     */
    
    public function logout(){
        Sentry::logout();
    }


    public function check()
    {
        if(Sentry::check()){
            return true;
        }
        return false;
    }

    public function guest()
    {
        if(Sentry::check()){
            return false;
        }
        return true;
    }

}