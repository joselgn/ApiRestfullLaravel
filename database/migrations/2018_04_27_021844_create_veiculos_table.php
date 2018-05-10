<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVeiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('veiculos', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('vendido')->comment('Vendido? 1-Nao / 2-Sim');            
            $table->integer('ano',false);
            $table->string('marca');
            $table->string('veiculo');
            $table->text('descricao')->nullable();
            $table->timestamps();
        });
    }//up

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('veiculo');
    }
}
