<?php

class RolesTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('roles')->truncate();
        
		\DB::table('roles')->insert(array (
			0 => 
			array (
				'id' => '1',
				'name' => 'Administrator',
				'primary_id' => '1',
				'assignable' => '0',
				'deleted_at' => NULL,
				'created_at' => '2014-11-19 18:49:28',
				'updated_at' => '2014-11-19 18:49:28',
			),
			1 => 
			array (
				'id' => '2',
				'name' => 'Marketing',
				'primary_id' => '2',
				'assignable' => '1',
				'deleted_at' => NULL,
				'created_at' => '2014-11-19 19:09:26',
				'updated_at' => '2014-11-19 19:09:26',
			),
			2 => 
			array (
				'id' => '3',
				'name' => 'Publisher',
				'primary_id' => '3',
				'assignable' => '1',
				'deleted_at' => NULL,
				'created_at' => '2014-11-19 19:10:09',
				'updated_at' => '2014-11-19 19:10:09',
			),
			3 => 
			array (
				'id' => '4',
				'name' => 'Regulator',
				'primary_id' => '4',
				'assignable' => '1',
				'deleted_at' => NULL,
				'created_at' => '2014-11-19 19:10:19',
				'updated_at' => '2014-11-19 19:10:19',
			),
		));
	}

}
