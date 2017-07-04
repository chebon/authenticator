<?php namespace Ejimba\Authenticator\Facades;

use Illuminate\Support\Facades\Facade;

class Authenticator extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'authenticator'; }

}