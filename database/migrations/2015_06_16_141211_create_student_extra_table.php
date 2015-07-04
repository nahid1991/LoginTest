<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentExtraTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('students', function(Blueprint $table)
        {
            $table->string('username')->index();
            $table->foreign('username')->references('username')->on('users')->onDelete('cascade');
            $table->integer('corrects');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('students', function(Blueprint $table)
        {
            $table->dropColumn('username');
            $table->dropColumn('corrects');
        });
	}

}
