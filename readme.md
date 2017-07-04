# Authenticator

A laravel 4 authentication package based on [Sentry](https://github.com/cartalyst/sentry)

## Installation

I highly recommend use of [Composer](http://getcomposer.org/) for installation. Add the following "require" to your `composer.json` file and run the `composer install` command to install it.

##### Laravel 4.2

```json
{
    "require": {
        "ejimba/authenticator": "0.1.x"
    }
}
```

Then, in your `config/app.php` add this line to your 'providers' array.

```php
'Ejimba\Authenticator\AuthenticatorServiceProvider',
```

After installing, you can publish the package configuration file into your application by running the following command:

`php artisan config:publish ejimba/authenticator`

You can now safely overide the individual settings

Run the migrations by running the following command:

`php artisan migrate --package=ejimba/authenticator`


## License

[The MIT License (MIT)](LICENSE)
