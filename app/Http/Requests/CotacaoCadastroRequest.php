<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class CotacaoCadastroRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            /**
             *  - Obrigatório
             *  - Deve ter 2 caracteres
             *  - Não deve repetir UF e transportadora
             */
            'uf' => ['required', 'size:2', Rule::unique('cotacao_frete')->where(function ($query) {
                return $query->where('uf', strtoupper($this->uf))->where('transportadora_id', $this->transportadora_id);
            })],

            /**
             * - Obrigatório
             * - Campo numérico
             * - Deve ser maior que 0 (zero)
             */
            'percentual_cotacao' => ['required', 'numeric', 'min:0', 'not_in:0'],

            /**
             * - Obrigatório
             * - Campo numérico
             * - Deve ser maior ou igual a 0 (zero)
             */
            'valor_extra' => ['required', 'numeric', 'min:0'],

            /**
             * - Obrigatório
             * - Deve existir a transportadora cadastrada
             */
            'transportadora_id' => ['required', 'exists:transportadora,id'],
        ];
    }
}
