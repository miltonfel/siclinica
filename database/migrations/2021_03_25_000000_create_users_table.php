<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('avatar')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('cpf', 11)->unique();
            $table->string('rg', 25)->nullable();
            $table->string('sexo', 20);
            $table->date('data_nascimento');
            $table->string('telefone1', 20);
            $table->string('telefone2', 20)->nullable();
            $table->string('logradouro', 100);
            $table->integer('numero');
            $table->string('complemento', 20)->nullable();
            $table->string('bairro', 40);
            $table->string('cidade', 20);
            $table->string('uf', 2);
            $table->string('cep', 8);
            $table->string('obs')->nullable();
            $table->string('tipo', 20)->default('paciente');
            $table->unsignedBigInteger('convenio_id')->nullable();
            $table->foreign('convenio_id')->references('id')->on('convenios');
            $table->unsignedBigInteger('especialidade_id')->nullable();
            $table->foreign('especialidade_id')->references('id')->on('especialidades');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
