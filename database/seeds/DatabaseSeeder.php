<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //adiciona o usuário admin
        DB::table('users')->insert([
            'name' => 'Administrador',
            'username' => 'admin',
            'email' => str_random(10).'@'.str_random(5).'.com',
            'password' => \Hash::make('admin'),
        ]);
        

        //adiciona os tipos de especificação
        DB::table('tipo_especificacaos')->insert([
            'nome' => 'Ferramentas'
        ]);
        
        DB::table('tipo_especificacaos')->insert([
            'nome' => 'Saneantes'
        ]);

        DB::table('tipo_especificacaos')->insert([
            'nome' => 'Alimentos'
        ]);

        DB::table('tipo_especificacaos')->insert([
            'nome' => 'Escritório'
        ]);

        DB::table('tipo_especificacaos')->insert([
            'nome' => 'Serviços'
        ]);

        DB::table('tipo_especificacaos')->insert([
            'nome' => 'Móveis'
        ]);

        DB::table('tipo_especificacaos')->insert([
            'nome' => 'Suprimentos'
        ]);

        DB::table('tipo_especificacaos')->insert([
            'nome' => 'Combustíveis'
        ]);

        DB::table('tipo_especificacaos')->insert([
            'nome' => 'Copa e Cozinha'
        ]);

        DB::table('tipo_especificacaos')->insert([
            'nome' => 'Vestuário'
        ]);

        DB::table('tipo_especificacaos')->insert([
            'nome' => 'E.P.I.'
        ]);

        DB::table('tipo_especificacaos')->insert([
            'nome' => 'Limpeza'
        ]);

        DB::table('tipo_especificacaos')->insert([
            'nome' => 'Higiene'
        ]);

        DB::table('tipo_especificacaos')->insert([
            'nome' => 'Laboratório'
        ]);

        DB::table('tipo_especificacaos')->insert([
            'nome' => 'Construção e Acabamento'
        ]);

        DB::table('tipo_especificacaos')->insert([
            'nome' => 'Médico e Hospitalar'
        ]);

        DB::table('tipo_especificacaos')->insert([
            'nome' => 'Elétrico'
        ]);
    }
}
