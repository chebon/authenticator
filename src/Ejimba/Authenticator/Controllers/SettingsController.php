<?php

namespace Ejimba\Authenticator\Controllers;

use Ejimba\Authenticator\Models\Group;
use Ejimba\Authenticator\Models\User;

use View, Input, Redirect, Auth, Config, Lang, Authenticator, Validator;

class SettingsController extends BaseController {
	
	public function __construct()
    {
        $this->beforeFilter('authenticator.auth');
    }

    /**
    * 
    * Displays the settings page
    * 
    **/

    public function index()
    {
        return View::make(Config::get('authenticator::views.settings'));
    }
}