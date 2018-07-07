<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalificacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_materias', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_t_materias');
            $table->string('nombre', 80);
            $table->integer('activo');
        });

        Schema::create('t_alumnos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_t_usuarios');
            $table->string('nombre', 80);
            $table->string('ap_paterno', 80);
            $table->string('ap_materno', 80);
            $table->integer('activo');
        });

        Schema::create('t_calificaciones', function (Blueprint $table) {
            $table->increments('id_t_calificaciones');
            $table->integer('id_t_materias')->unsigned();
            $table->integer('id_t_usuarios')->unsigned();
            $table->decimal('calificacion', 10, 2);
            $table->date('fecha_registro');

            $table->foreign('id_t_materias')->references('id_t_materias')->on('t_materias')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_t_usuarios')->references('id_t_usuarios')->on('t_alumnos')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_calificaciones');
    }
}
