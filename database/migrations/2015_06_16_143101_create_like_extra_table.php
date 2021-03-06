<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLikeExtraTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('likes', function(Blueprint $table)
        {
            $table->string('username')->index();
            $table->foreign('username')->references('username')->on('users')->onDelete('cascade');
            $table->integer('q_id')->unsigned()->index()->nullable();
            $table->foreign('q_id')->references('que_id')->on('questions')->onDelete('cascade');
            $table->integer('cmnt_id')->unsigned()->index()->nullable();
            $table->foreign('cmnt_id')->references('comment_id')->on('comments')->onDelete('cascade');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('likes', function(Blueprint $table)
        {
            $table->dropColumn('username');
            $table->dropColumn('q_id');
            $table->dropColumn('cmnt_id');
        });
	}

}
