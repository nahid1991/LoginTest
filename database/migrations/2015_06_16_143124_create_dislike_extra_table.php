<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDislikeExtraTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
    public function up()
    {
        Schema::table('dislikes', function(Blueprint $table)
        {
            $table->string('username')->index();
            $table->foreign('username')->references('username')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dislikes', function(Blueprint $table)
        {
            $table->dropColumn('username');
        });
	}

}
