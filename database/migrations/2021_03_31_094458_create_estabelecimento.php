<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstabelecimento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estabelecimento', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('razaosocial')->nullable();
            $table->string('cpfCnpj', 15);
            $table->string('rgIe', 15);
            $table->string('telefone1', 20);
            $table->string('telefone2', 20)->nullable();
            $table->string('logradouro', 100);
            $table->integer('numero');
            $table->string('complemento', 20)->nullable();
            $table->string('bairro', 40);
            $table->string('cidade', 20);
            $table->string('uf', 2);
            $table->string('cep', 8);
            $table->string('email');
            $table->string('site');
            $table->string('propaganda');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estabelecimento');
    }
}
