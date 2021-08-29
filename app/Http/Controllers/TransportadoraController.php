<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransportadoraModel;


class TransportadoraController extends Controller
{
    /**
     * Listar todas as transportadoras
     */
    public function listar()
    {
        return TransportadoraModel::all();
    }
}
