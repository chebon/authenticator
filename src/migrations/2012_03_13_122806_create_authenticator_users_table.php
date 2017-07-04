<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthenticatorUsersTable extends Migration {

	public function __construct()
    {
        // Get the prefix
        $this->prefix = Config::get('authenticator::prefix', '');
    }

	/**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Bring to local scope
        $prefix = $this->prefix;

        // Here lies the users table
        Schema::create($prefix.'users', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('first_name')->nullable()->index();
            $table->string('last_name')->nullable()->index();
            $table->string('phone')->nullable()->index();
            $table->string('username')->index();
            $table->string('email')->index();
            $table->string('password')->index();
            $table->string('salt');
            $table->text('permissions')->nullable();
            $table->boolean('activated')->default(0);
            $table->string('activation_code')->nullable()->index();
            $table->timestamp('activated_at')->nullable();
            $table->string('persist_code')->nullable();
            $table->timestamp('last_login')->nullable();
            $table->string('reset_password_code')->nullable()->index();
            $table->timestamps();
            $table->softDeletes();
        });

    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         // Bring to local scope
        $prefix = $this->prefix;

        // Drop the tables involved
        Schema::drop($prefix.'users');
    }
}