<?php

namespace App\Http\Controllers;

use App\Http\Requests\CotacaoCadastroRequest;
use App\Http\Requests\CotacaoConsultaRequest;
use App\Models\CotacaoModel;
use App\ViewModel\CotacaoViewModel;

class CotacaoController extends Controller
{
    /**
     * Listar todas cotações
     */
    public function listar()
    {
        return CotacaoModel::all();
    }

    /**
     * Cadastrar novas cotações
     */
    public function cadastro(CotacaoCadastroRequest $request)
    {
        try {

            $cotacao = new CotacaoModel();
            $cotacao->uf = strtoupper($request->uf);
            $cotacao->percentual_cotacao = $request->percentual_cotacao;
            $cotacao->valor_extra = $request->valor_extra;
            $cotacao->transportadora_id = $request->transportadora_id;
            $cotacao->save();

            return ['mensagem' => 'Sucesso'];
        } catch (\PDOException $erro) {
            return response(['mensagem' => $erro], 500);
        }
    }

    /**
     * Consultar cotações
     */
    public function consulta(CotacaoConsultaRequest $request)
    {
        try {
            $cotacoes = CotacaoModel::where('uf', $request->uf)->get();
            $collection = collect();

            foreach ($cotacoes as $cotacao) {

                $valor_cotacao = $cotacao->valor_extra + (($request->valor_pedido / 100) * $cotacao->percentual_cotacao);

                $collection->add(new CotacaoViewModel(
                    $cotacao->uf,
                    $cotacao->transportadora_id,
                    $request->valor_pedido,
                    $valor_cotacao
                ));
            }
            return $collection->sortBy('valor_cotacao')->shift(3);

        } catch (\Exception $erro) {
            return response(['mensagem' => $erro], 500);
        }
    }
}
