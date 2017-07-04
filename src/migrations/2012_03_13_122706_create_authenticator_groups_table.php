<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthenticatorGroupsTable extends Migration {

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

        // Here lies the groups table
        Schema::create($prefix.'groups', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('description')->nullable();
            $table->text('permissions')->nullable();
            $table->timestamps();
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
        Schema::drop($prefix.'groups');
    }
}