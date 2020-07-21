<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlunosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alunos', function (Blueprint $table) {
            $table->id();   
            $table->string('nome', 60)->unique();
            $table->date('dataMatricula');
            $table->string('curso', 20);
            $table->string('turma', 20);            
            $table->boolean('situacao');            
            $table->string('imagem');
            $table->string('CEP', 9);
            $table->string('cidade', 20); 
            $table->string('estado', 2);
            $table->string('bairro', 20);
            $table->integer('numero');
            $table->string('complemento',20);  
            $table->string('rua',20);           
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
        Schema::dropIfExists('alunos');
    }
}
