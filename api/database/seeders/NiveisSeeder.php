<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NiveisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Inserir os níveis
        DB::table('niveis')->insert([
            ['nivel' => 'Junior'],
            ['nivel' => 'Pleno'],
            ['nivel' => 'Senior'],
        ]);

        $nivels = DB::table('niveis')->whereIn('nivel', ['Junior', 'Pleno', 'Senior'])->pluck('id', 'nivel');

        DB::table('devs')->insert([
            [
                'nivel_id' => $nivels['Junior'], // ID do nível 'Junior'
                'sexo' => 'M',
                'data_nascimento' => '1990-05-15',
                'hobby' => 'Futebol',
                'nome' => 'Marcelo Herique',
            ],
            [
                'nivel_id' => $nivels['Pleno'], // ID do nível 'Pleno'
                'sexo' => 'F',
                'data_nascimento' => '1985-11-22',
                'hobby' => 'Leitura',
                'nome' => 'Maria Oliveira',
            ],
            [
                'nivel_id' => $nivels['Senior'], // ID do nível 'Senior'
                'sexo' => 'M',
                'data_nascimento' => '2000-03-10',
                'hobby' => 'Video Games',
                'nome' => 'Carlos Pereira',
            ],
        ]);

    }
}
