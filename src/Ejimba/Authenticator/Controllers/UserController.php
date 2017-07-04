<?php

namespace Ejimba\Authenticator\Controllers;

class UserController extends BaseController {
    
    public function __construct()
    {
        $this->beforeFilter('authenticator.auth');
    }

    public function index()
    {

    }

    public function show($id)
    {
        
    }

    public function edit($id)
    {
        
    }

    public function update($id)
    {
        
    }

    public function destroy($id)
    {
    	
    }
}
