<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_dates_users', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('event_date_id')->nullable()->unsigned()->index();
            $table->integer('user_id')->nullable()->unsigned()->index();
            $table->enum('rsvp_status', ['yes', 'no', 'maybe']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('event_dates_users');
    }
}
