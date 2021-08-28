<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Oderco extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transportadora', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 45);
            $table->timestamps();
        });

        Schema::create('cotacao_frete', function (Blueprint $table) {
            $table->increments('id');
            $table->char('uf', 2);
            $table->decimal('percentual_cotacao', $precision = 10, $scale = 2);
            $table->decimal('valor_extra', $precision = 10, $scale = 2);
            $table->unsignedInteger('transportadora_id');
            $table->foreign('transportadora_id')->references('id')->on('transportadora')->onDelete('cascade');
            $table->timestamps();
            $table->unique(['uf', 'transportadora_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cotacao_frete');
        Schema::drop('transportadora');
    }
}
