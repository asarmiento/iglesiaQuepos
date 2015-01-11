<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGastosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('gastos', function(Blueprint $table) {
            $table->increments('id');
            $table->string('num_factura');
            $table->date('date');
            $table->date('datefactura');
            $table->decimal('monto', 20, 2);
            $table->text('descripcion');
            $table->string('factura');
            $table->integer('departamentos_id')->unsigned()->index();
            $table->foreign('departamentos_id')->references('id')->on('departamentos')->onDelete('no action');
            $table->integer('cheques_id')->unsigned()->index();
            $table->foreign('cheques_id')->references('id')->on('cheques')->onDelete('no action');
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
    public function down() {
        Schema::drop('gastos');
    }

}
