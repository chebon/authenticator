<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthenticatorUsersGroupsTable extends Migration {

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

        // Here lies the users_groups relationship table
        Schema::create($prefix.'users_groups', function($table) use ($prefix)
        {
            $table->engine = 'InnoDB';
            $table->integer('user_id')->unsigned();
            $table->integer('group_id')->unsigned();
            $table->primary(array('user_id', 'group_id'));
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
        Schema::drop($prefix.'users_groups');
    }
}