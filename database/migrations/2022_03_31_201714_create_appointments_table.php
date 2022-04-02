<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('asunto', 255);
            $table->datetime('fecha_hora')->nullable();
            $table->unsignedBigInteger('state_id')->comment('Creada para Estado de Cita');
            $table->unsignedBigInteger('client_id')->comment('Creada para Cliente');

            $table->foreign('state_id')->references('id')->on('states');
            $table->foreign('client_id')->references('id')->on('clients');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}
