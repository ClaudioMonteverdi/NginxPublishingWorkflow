<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateApprovalRequirementsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('approval_requirements', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('revision_id')->unsigned()->index();
			$table->integer('approvable_id')->unsigned()->index();
			$table->string('approvable_type')->index();
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
		Schema::drop('approval_requirements');
	}

}
