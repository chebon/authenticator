<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Default Authentication Driver
    |--------------------------------------------------------------------------
    |
    | This option controls the authentication driver that will be utilized.
    | This drivers manages the retrieval and authentication of the users
    | attempting to get access to protected areas of your application.
    |
    | Supported: "eloquent" (more coming soon).
    |
    */

    'driver' => 'eloquent',

    /*
    |--------------------------------------------------------------------------
    | Database Tables Prefix
    |--------------------------------------------------------------------------
    |
    | This option allows you to specify table prefixes used by Authenticator
    |
    | eg. for auth_users specify below as 'prefix' => 'auth_'
    |
    */

    'prefix' => '',

    /*
    |--------------------------------------------------------------------------
    | Default Hasher
    |--------------------------------------------------------------------------
    |
    | This option allows you to specify the default hasher used by Authenticator
    |
    | Supported: "native", "bcrypt", "sha256", "whirlpool"
    |
    */

    'hasher' => 'native',

    /*
    |--------------------------------------------------------------------------
    | Cookie
    |--------------------------------------------------------------------------
    |
    | Configuration specific to the cookie component of Authenticator.
    |
    */

    'cookie' => array(

        /*
        |--------------------------------------------------------------------------
        | Default Cookie Key
        |--------------------------------------------------------------------------
        |
        | This option allows you to specify the default cookie key used by Authenticator.
        |
        | Supported: string
        |
        */

        'key' => 'authenticator_cookie',

    ),

    /*
    |--------------------------------------------------------------------------
    | Groups
    |--------------------------------------------------------------------------
    |
    | Configuration specific to the group management component of Authenticator.
    |
    */

    'groups' => array(

        /*
        |--------------------------------------------------------------------------
        | Model
        |--------------------------------------------------------------------------
        |
        | When using the "eloquent" driver, we need to know which
        | Eloquent models should be used throughout Authenticator.
        |
        */

        'model' => 'Ejimba\Authenticator\Models\Group',

    ),

    /*
    |--------------------------------------------------------------------------
    | Users
    |--------------------------------------------------------------------------
    |
    | Configuration specific to the user management component of Authenticator.
    |
    */

    'users' => array(

        /*
        |--------------------------------------------------------------------------
        | Model
        |--------------------------------------------------------------------------
        |
        | When using the "eloquent" driver, we need to know which
        | Eloquent models should be used throughout Authenticator.
        |
        */

        'model' => 'Ejimba\Authenticator\Models\User',

        /*
        |--------------------------------------------------------------------------
        | Login Attribute
        |--------------------------------------------------------------------------
        |
        | If you're using the "eloquent" driver and extending the base Eloquent
        | model, we allow you to globally override the login attribute without
        | even subclassing the model, simply by specifying the attribute below.
        |
        */

        'login_attribute' => 'email',

        /*
        |--------------------------------------------------------------------------
        | Enable Public Registration
        |--------------------------------------------------------------------------
        |
        | This defines if public registration is allowed.
        |
        | Default to true.
        |
        */

        'registration_allowed' => true,

         /*
        |--------------------------------------------------------------------------
        | Require Account Activation
        |--------------------------------------------------------------------------
        |
        | This defines if public registration requires email activation.
        |
        | Default to true.
        |
        */

        'activation' => true,

         /*
        |--------------------------------------------------------------------------
        | Enable Password Reset
        |--------------------------------------------------------------------------
        |
        | This defines if email password resets are allowed. If set to false, on
        | forgot password attempt, uses are prompted to contact the system
        | administrator.
        |
        | If user account has no email, email password is reset is automatically
        | disabled.
        |
        | Default to true.
        |
        */

        'password_reset_allowed' => true,

         /*
        |--------------------------------------------------------------------------
        | Login Redirect Fallback URI
        |--------------------------------------------------------------------------
        |
        | Authenticator will automatically redirect the user to the URI they were
        | trying to access before being caught by the authentication filter.
        | This is fallback URI in case the intended destination is not available.
        |
        |
        */

        'login_redirect_fallback_uri' => '/',

         /*
        |--------------------------------------------------------------------------
        | Logout Redirect URI
        |--------------------------------------------------------------------------
        |
        | Specifies the URI to redirect the user after logging out of the system
        |
        */

        'logout_redirect_uri' => '/',

    ),

    /*
    |--------------------------------------------------------------------------
    | User Groups Pivot Table
    |--------------------------------------------------------------------------
    |
    | When using the "eloquent" driver, you can specify the table name
    | for the user groups pivot table.
    |
    | Default: users_groups
    |
    */

    'user_groups_pivot_table' => 'users_groups',

    /*
    |--------------------------------------------------------------------------
    | Throttling
    |--------------------------------------------------------------------------
    |
    | Throttling is an optional security feature for authentication, which
    | enables limiting of login attempts and the suspension & banning of users.
    |
    */

    'throttling' => array(

        /*
        |--------------------------------------------------------------------------
        | Throttling
        |--------------------------------------------------------------------------
        |
        | Enable throttling or not. Throttling is where users are only allowed a
        | certain number of login attempts before they are suspended. Suspension
        | must be removed before a new login attempt is allowed.
        |
        */

        'enabled' => true,

        /*
        |--------------------------------------------------------------------------
        | Model
        |--------------------------------------------------------------------------
        |
        | When using the "eloquent" driver, we need to know which
        | Eloquent models should be used throughout Authenticator.
        |
        */

        'model' => 'Ejimba\Authenticator\Models\Throttle',

        /*
        |--------------------------------------------------------------------------
        | Attempts Limit
        |--------------------------------------------------------------------------
        |
        | When using the "eloquent" driver and extending the base Eloquent model,
        | you have the option to globally set the login attempts.
        |
        | Supported: int
        |
        */

        'attempt_limit' => 5,

        /*
        |--------------------------------------------------------------------------
        | Suspension Time
        |--------------------------------------------------------------------------
        |
        | When using the "eloquent" driver and extending the base Eloquent model,
        | you have the option to globally set the suspension time, in minutes.
        |
        | Supported: int
        |
        */

        'suspension_time' => 15,

    ),

    /*
    |--------------------------------------------------------------------------
    | Routing
    |--------------------------------------------------------------------------
    |
    | Configurations for routing of Authenticator activities
    |
    */
    'routing' => array(

        /*
        |--------------------------------------------------------------------------
        | Prefix
        |--------------------------------------------------------------------------
        |
        | Prefix for authenticator routes
        |
        |  e.g http://www.domain.com/auth/login for login route, use
        |
        |  'prefix' => 'auth'
        */

        'prefix' => '',

        /*
        |--------------------------------------------------------------------------
        | Subdomain
        |--------------------------------------------------------------------------
        |
        | Subdomain for authenticator routes
        |
        |  e.g http://auth.domain.com/login for login route, use
        |
        |  'subdomain' => 'auth'
        |
        | Default: Commented out
        |
        */

        // 'subdomain' => 'auth.site.com',
    ),

    
    /*
    |--------------------------------------------------------------------------
    | Views
    |--------------------------------------------------------------------------
    |
    | Configuration specific to the views used by Authenticator.
    |
    */

    'views' => array(

        /*
        |--------------------------------------------------------------------------
        | Login View
        |--------------------------------------------------------------------------
        |
        | View used to render the login form. Also used by the helper method
        | Authenticator::displayLoginForm()
        | 
        | To use your own login form, replace the view name here.
        |
        |  e.g To use app/views/user/login.blade.php:
        |
        |  'login' => 'user.login'
        */

        'login' => 'authenticator::users.login',

        /*
        |--------------------------------------------------------------------------
        | Forgot Password View
        |--------------------------------------------------------------------------
        |
        | View used to render the forgot password form. Also used by the helper method
        | Authenticator::displayForgotForm()
        | 
        | To use your own forgot form, replace the view name here.
        |
        |  e.g To use app/views/user/forgot.blade.php:
        |
        |  'forgot' => 'user.forgot'
        */

        'forgot' => 'authenticator::users.forgot',

        /*
        |--------------------------------------------------------------------------
        | Reset Password View
        |--------------------------------------------------------------------------
        |
        | View used to render the reset password form. Also used by the helper method
        | Authenticator::displayResetForm()
        | 
        | To use your own reset form, replace the view name here.
        |
        |  e.g To use app/views/user/reset.blade.php:
        |
        |  'reset' => 'user.reset'
        */

        'reset' => 'authenticator::users.reset',

        /*
        |--------------------------------------------------------------------------
        | Register View
        |--------------------------------------------------------------------------
        |
        | View used to render the register form. Also used by the helper method
        | Authenticator::displayRegisterForm()
        | 
        | To use your own register form, replace the view name here.
        |
        |  e.g To use app/views/user/register.blade.php:
        |
        |  'register' => 'user.register'
        */

        'register' => 'authenticator::users.register',

        /*
        |--------------------------------------------------------------------------
        | Settings View
        |--------------------------------------------------------------------------
        |
        | View used to render the settings form. Also used by the helper method
        | Authenticator::displaySettingsForm()
        | 
        | To use your own settings form, replace the view name here.
        |
        |  e.g To use app/views/settings/index.blade.php:
        |
        |  'settings' => 'settings.index'
        */

        'settings' => 'authenticator::settings.index',

         /*
        |--------------------------------------------------------------------------
        | Reset Password Email View
        |--------------------------------------------------------------------------
        |
        | View used for password reset email
        | 
        | To use your own reset password email view, replace the view name here.
        |
        |  e.g To use app/views/emails/auth/reminder.blade.php:
        |
        |  'reset_password_email' => 'emails.auth.reminder'
        |
        |  ensure you have $user and $token.
        */

        'reset_password_email' => 'authenticator::emails.auth.reminder',

         /*
        |--------------------------------------------------------------------------
        | Account Activation Email View
        |--------------------------------------------------------------------------
        |
        | View used for account activation email
        | 
        | To use your own account activation email view, replace the view name here.
        |
        |  e.g To use app/views/emails/auth/activation.blade.php:
        |
        |  'account_activation_email' => 'emails.auth.activation'
        |
        |  ensure you have $user and $token.
        */

        'account_activation_email' => 'authenticator::emails.auth.activation',

        /*
        |--------------------------------------------------------------------------
        | Contact System Admin View
        |--------------------------------------------------------------------------
        |
        | View used to render the general error a.k.a contact system administrator
        | 
        | To use your own system admin form, replace the view name here.
        |
        |  e.g To use app/views/admin/error.blade.php:
        |
        |  'contact_system_admin' => 'admin.error'
        */

        'contact_system_admin' => 'authenticator::users.error',
    ),

    /*
    |--------------------------------------------------------------------------
    | Password reset expiration
    |--------------------------------------------------------------------------
    |
    | By default. A password reset request will expire after 7 hours. With the
    | line below you will be able to customize the duration of the reset
    | requests here.
    |
    */

    'password_reset_expiration' => 7, // hours

);