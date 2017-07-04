<?php

namespace Ejimba\Authenticator\Models;

use Config;
use Cartalyst\Sentry\Throttling\Eloquent\Throttle as SentryThrottle;

class Throttle extends SentryThrottle{

	/**
     * Table prefix
     *
     * @var string
     */
    protected $prefix = '';

    /**
     * Create a new Eloquent model instance.
     *
     * @param  array  $attributes
     * @return void
     */

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);

        // Set the prefix
        $this->prefix = Config::get('authenticator::prefix', '');

        $this->table = $this->prefix.$this->getTable();
    }

}