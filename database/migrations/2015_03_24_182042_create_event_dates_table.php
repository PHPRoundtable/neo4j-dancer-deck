<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events_dates', function(Blueprint $table)
        {
            $table->increments('id');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('timezone')->nullable();

            $table->string('buy_ticket_url')->nullable();
            $table->string('schedule_url')->nullable();
            $table->string('competition_results_url')->nullable();

            $table->boolean('is_wsdc')->nullable();
            $table->boolean('is_nasde')->nullable();
            $table->boolean('is_aance')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('events_dates');
    }
}
