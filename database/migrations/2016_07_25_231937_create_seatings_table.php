<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seatings', function(Blueprint $table) {
            $table->increments('id',true);
            $table->date('date');
            $table->decimal('amount', 20, 2);
            $table->integer('departament_id')->unsigned()->nullable()->index();
            $table->foreign('departament_id')->references('id')->on('departaments')->onDelete('no action');
            $table->integer('record_id')->unsigned()->nullable()->index();
            $table->foreign('record_id')->references('id')->on('records')->onDelete('no action');
            $table->integer('check_id')->unsigned()->nullable()->index();
            $table->foreign('check_id')->references('id')->on('checks')->onDelete('no action');
            $table->integer('account_id')->unsigned()->nullable()->index();
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('no action');
            $table->engine = 'InnoDB';
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
        Schema::drop('seatings');
    }
}