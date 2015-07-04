<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionExtraTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('questions', function(Blueprint $table)
        {
            $table->string('username')->index();
            $table->foreign('username')->references('username')->on('users')->onDelete('cascade');
            $table->integer('tag_id')->unsigned()->index();
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('questions', function(Blueprint $table)
        {
            $table->dropColumn('username');
            $table->dropColumn('tag_id');
        });
	}

}
