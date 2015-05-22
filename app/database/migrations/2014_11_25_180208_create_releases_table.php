<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReleasesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('releases', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('name');
			$table->integer('publisher_id')->unsigned()->integer();
			$table->enum('status', ['Pending', 'Approved', 'Published'])->default('Pending');
			$table->integer('creator_id')->unsigned()->index();
			$table->datetime('release_date')->nullable();
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
		Schema::drop('releases');
	}

}
