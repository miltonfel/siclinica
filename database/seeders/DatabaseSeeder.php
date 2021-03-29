<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
        'name' => 'Administrador',
        'email' => 'admin@admin.com.br',
        'password' => Hash::make('123mudar'),
    ]);

    DB::table('convenios')->insert([
        'descricao' => 'Particular',
    ]);

    DB::table('especialidades')->insert([
        'descricao' => 'Clínica Geral',
    ]);

        // \App\Models\User::factory(10)->create();
    }
}
