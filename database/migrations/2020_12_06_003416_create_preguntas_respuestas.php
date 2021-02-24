<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreguntasRespuestas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableNames = config('permission.table_names');

        //table ciclos
        Schema::create('ciclos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ciclo', 20)->unique();
            $table->string('ciclo_actual', 1)->nullable();
            $table->timestamps();
        });

        //tabla de comprobacion de coevaluaciones
        Schema::create('comprobaciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ci_coevaluador_id', 10);
            $table->string('evaluado', 10);
            $table->string('estado', 1);
            $table->timestamps();
            $table->foreign('ci_coevaluador_id')->references('cedula')->on('users')->onDelete('cascade');
        });



        //table categorias
        Schema::create('categorias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre', 50);
            $table->timestamps();
        });

        //table preguntas
        Schema::create('preguntas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('titulo');
            $table->string('descripcion');
            $table->bigInteger('categoria_id')->unsigned();
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade');
            $table->string('tipo');
            $table->timestamps();
        });

        //table respuestas
        Schema::create('respuestas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('resultado');
            $table->string('user_id', 10);
            $table->bigInteger('pregunta_id')->unsigned();
            $table->string('ciclo', 20);
            $table->string('categoria');
            $table->string('tipo');
            $table->string('materia')->nullable();
            $table->string('area_conocimiento')->nullable();
            $table->string('observaciones')->nullable();
            $table->string('coevaluador', 10)->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('cedula')->on('users')->onDelete('cascade');
            $table->foreign('pregunta_id')->references('id')->on('preguntas')->onDelete('cascade');
        });

        //table area de conocimientos
        Schema::create('area_conocimientos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('area')->unique();
            $table->timestamps();
        });

        //table materias
        Schema::create('materias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('materia');
            $table->string('area');
            $table->timestamps();
        });

        //table asignacion area de conocimientos
        Schema::create('area_users', function (Blueprint $table) {
            $table->unsignedBigInteger('area_conocimiento_id');;
            $table->string('usuario', 10);
            $table->timestamps();

            $table->foreign('usuario')->references('cedula')->on('users')->onDelete('cascade');
            $table->foreign('area_conocimiento_id')->references('id')->on('area_conocimientos')->onDelete('cascade');
        });

        //table asignacion de materias a docentes
        Schema::create('materia_users', function (Blueprint $table) {
            $table->unsignedBigInteger('materias_id');;
            $table->string('docente', 10);
            $table->timestamps();

            $table->foreign('docente')->references('cedula')->on('users')->onDelete('cascade');
            $table->foreign('materias_id')->references('id')->on('materias')->onDelete('cascade');
        });

        //relacion area conocimiento-materias
        Schema::create('area_has_materias', function (Blueprint $table) {
            $table->unsignedBigInteger('area_id');
            $table->unsignedBigInteger('materia_id');
            $table->timestamps();

            $table->foreign('area_id')->references('id')->on('area_conocimientos')->onDelete('cascade');
            $table->foreign('materia_id')->references('id')->on('materias')->onDelete('cascade');
        });

        //tabla de comprobacion de autoevaluaciones
        Schema::create('comprobacione_autos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('docente', 10);
            $table->string('materia');
            $table->string('estado', 1);
            $table->timestamps();
            $table->foreign('docente')->references('cedula')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categorias');
        Schema::dropIfExists('preguntas');
        Schema::dropIfExists('respuestas');
    }
}
