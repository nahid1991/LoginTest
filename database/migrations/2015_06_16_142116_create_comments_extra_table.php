<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsExtraTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('comments', function(Blueprint $table)
        {
            $table->string('username')->index();
            $table->foreign('username')->references('username')->on('users')->onDelete('cascade');
            $table->boolean('correct');
            $table->integer('q_id')->unsigned()->index();
            $table->foreign('q_id')->references('id')->on('questions')->onDelete('cascade');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('comments', function(Blueprint $table)
        {
            $table->dropColumn('username');
            $table->dropColumn('correct');
            $table->dropColumn('q_id');
        });
	}

}
