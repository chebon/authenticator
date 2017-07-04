<?php

use Illuminate\Database\Seeder;

class AuthenticatorDatabaseSeeder extends Seeder {

	protected $prefix = '';

	public function __construct()
    {
        // Get the prefix
        $this->prefix = Config::get('authenticator::prefix', '');
    }

	public function run()
	{
		Eloquent::unguard();
		$this->seedUsers();
		$this->seedGroups();
		$this->seedUsersGroups();
		
	}

	public function seedUsers()
	{
		$prefix = $this->prefix;

		DB::table($prefix.'users')->truncate();

		$users = array(
			array(
					'username' => 'admin',
					'first_name' => 'John',
					'last_name' => 'Doe',
					'email' => 'admin@yoursite.com',
					'password' =>'password',
					'activated' => 1,
				),
			array(
					'username' => 'user',
					'first_name' => 'Jane',
					'last_name' => 'Doe',
					'email' => 'user@yoursite.com',
					'password' =>'password',
					'activated' => 1,
				)
			);

		foreach ($users as $key => $user) {
			Authenticator::createUser($user);
		}
	}

	public function seedGroups()
	{
		$prefix = $this->prefix;

		DB::table($prefix.'groups')->truncate();

		$groups = array(
			array(
					'name' => 'Super Admin',
					'description' => 'Super Admin Group',
					'permissions' => array(
			            'superuser' => 1,
			        ),
			),
			array(
					'name' => 'Admin',
					'description' => 'Admins Group',
					'permissions' => array(
						'groups' => 1,
						'users' => 1,
					),
			),
			array(
					'name' => 'User',
					'description' => 'Users Group',
					'permissions' => array(
						'dashboard' => 1,
					),
			),
		);

		foreach ($groups as $key => $group) {
			Authenticator::createGroup($group);
		}
	}

	public function seedUsersGroups()
	{
		$prefix = $this->prefix;

		DB::table($prefix.'users_groups')->truncate();

		$group = Authenticator::findGroupByName('Super Admin');
		$user = Authenticator::findUserByLogin('admin@yoursite.com');
		if((!is_null($group)) && (!is_null($user))){
			$user->addGroup($group);
		}
		
		$group = Authenticator::findGroupByName('User');
		$user = Authenticator::findUserByLogin('user@yoursite.com');
		if((!is_null($group)) && (!is_null($user))){
			$user->addGroup($group);
		}
	}

}
