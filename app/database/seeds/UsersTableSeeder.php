<?php

class UsersTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('users')->truncate();
        
		\DB::table('users')->insert(array (
			0 => 
			array (
				'id' => '1',
				'role_id' => '1',
				'email' => 'dallen@theatomgroup.com',
				'username' => 'admin',
				'password' => '$2y$10$BE0eQcY64.jlExJQpRqoGOkBfonzyxSzxtf/9uzchxQnk.46zHpJa',
				'approval_password' => '$2y$10$kNaxFc.atax.hEThS24U9.IQAAmfrkCvu.VOKvlzMMy2cIOjmoR9a',
				'first_name' => 'David',
				'last_name' => 'Allen',
				'remember_token' => NULL,
				'deleted_at' => NULL,
				'created_at' => '2014-11-19 18:47:33',
				'updated_at' => '2014-11-21 18:50:46',
			),
			1 => 
			array (
				'id' => '2',
				'role_id' => '2',
				'email' => 'marketing@mailinator.com',
				'username' => 'marketing',
				'password' => '$2y$10$CYfmMChbH4/sMGUT637H5esTZLFFCfitstvtp5Ak4jM7kQ7O.QRAK',
				'approval_password' => '$2y$10$0qqGztiYu9JEd7UPCrMxRe8kqLfXixgavb0KU9IkQWORD0gXXlf3G',
				'first_name' => 'Bob',
				'last_name' => 'Marketing',
				'remember_token' => NULL,
				'deleted_at' => NULL,
				'created_at' => '2014-11-19 19:11:55',
				'updated_at' => '2014-11-21 18:50:53',
			),
			2 => 
			array (
				'id' => '3',
				'role_id' => '4',
				'email' => 'regulator@mailinator.com',
				'username' => 'regulator',
				'password' => '$2y$10$LxRV2DE2YY4IloW/Qo2OIu4a0b/nJnZpbfCfpgs6GOPGAnscVYk4.',
				'approval_password' => '$2y$10$8XUPg.5shADlpmzJ/LrY3eqgMzrJETL1p5xTkv8bdpUqVoEQbx4AO',
				'first_name' => 'Suzy',
				'last_name' => 'Regulator',
				'remember_token' => NULL,
				'deleted_at' => NULL,
				'created_at' => '2014-11-19 19:13:28',
				'updated_at' => '2014-11-21 18:50:59',
			),
			3 => 
			array (
				'id' => '4',
				'role_id' => '3',
				'email' => 'publisher@mailinator.com',
				'username' => 'publisher',
				'password' => '$2y$10$ifDpb/4BdJbDwNSa7kZXmOVvHTcS1uGWTjn7WqkWa0.73.HgwLc9e',
				'approval_password' => '$2y$10$bpd.lq6l4NU2vEsvkVoAouZAjJDo38p1AvH1lVsOow7GtnXBXZd8q',
				'first_name' => 'Tim',
				'last_name' => 'Publisher',
				'remember_token' => NULL,
				'deleted_at' => NULL,
				'created_at' => '2014-11-19 19:14:28',
				'updated_at' => '2014-11-21 18:51:04',
			),
		));
	}

}
