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
            /*$table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->string('cpf', 11)->unique();
            $table->string('rg', 25)->nullable();
            $table->string('sexo', 20);
            $table->date('data_nascimento');
            $table->string('telefone1', 20);
            $table->string('telefone2', 20)->nullable();
            $table->string('logradouro', 11);
            $table->integer('numero');
            $table->string('complemento', 20)->nullable();
            $table->string('bairro', 40);
            $table->string('cidade', 20);
            $table->string('uf', 2);
            $table->string('cep', 8);
            $table->unsignedBigInteger('user_type_id');
            $table->foreign('user_type_id')->references('id')->on('user_types');*/
            
            $table->increments('id');
            $table->string('name');
            $table->string('google_id');
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->string('avatar')->nullable();
            $table->string('avatar_original')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
