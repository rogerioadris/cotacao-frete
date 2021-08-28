<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TransportadoraModel;

class TransportadoraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TransportadoraModel::create([
            'nome' => 'Brasspress Transportes Urgentes'
        ]);
        TransportadoraModel::create([
            'nome' => 'Rodonaves Transportes e Encomendas'
        ]);
        TransportadoraModel::create([
            'nome' => 'Alfa Transportes'
        ]);
        TransportadoraModel::create([
            'nome' => 'Transportes Translovato'
        ]);
    }
}
