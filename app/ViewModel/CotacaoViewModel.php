<?php

namespace App\ViewModel;

class CotacaoViewModel
{
    public $uf;

    public $valor_pedido;

    public $transportadora_id;

    public $valor_cotacao;

    public function __construct(string $uf, int $transportadora_id, float $valor_pedido, $valor_cotacao)
    {
        $this->uf = $uf;
        $this->transportadora_id = $transportadora_id;
        $this->valor_pedido = $valor_pedido;
        $this->valor_cotacao = $valor_cotacao;
    }
}
