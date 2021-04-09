<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceituarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    //receituario é um banco para auxiliar na confecção das receitas, ficando pré cadastradas.
    public function up()
    {
        Schema::create('receituarios', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('titulo');
            $table->text('descricao');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('receituarios');
    }
}
