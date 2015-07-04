<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
    public function up()
    {
        Schema::create('notification_user', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('notify_id')->unsigned()->index();
            $table->foreign('notify_id')->references('id')->on('notifications')->onDelete('cascade');
            $table->string('username')->index();
            $table->foreign('username')->references('username')->on('users')->onDelete('cascade');
            $table->boolean('is_read');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('notification_user');
    }

}
