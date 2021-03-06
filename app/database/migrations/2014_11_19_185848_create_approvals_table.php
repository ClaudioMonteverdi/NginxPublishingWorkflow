<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateApprovalsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('approvals', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('revision_id')->unsigned()->index();
			$table->integer('role_id')->unsigned()->index();
			$table->integer('user_id')->unsigned()->index();
			$table->integer('approval_requirement_id')->unsigned()->index();
			$table->softDeletes();
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
		Schema::drop('approvals');
	}

}
