<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthenticatorThrottleTable extends Migration {

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

        // Here lies the throttle table
        Schema::create($prefix.'throttle', function($table) use ($prefix)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable()->index();
            $table->string('ip_address')->nullable();
            $table->integer('attempts')->default(0);
            $table->boolean('suspended')->default(0);
            $table->boolean('banned')->default(0);
            $table->timestamp('last_attempt_at')->nullable();
            $table->timestamp('suspended_at')->nullable();
            $table->timestamp('banned_at')->nullable();
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
        Schema::drop($prefix.'throttle');
    }
}