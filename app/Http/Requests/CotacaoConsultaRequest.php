<?php

namespace App\Http\Requests;

class CotacaoConsultaRequest extends FormRequest
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
             *  - Deve existir a transportadora cadastrada
             */
            'uf' => ['required', 'size:2', 'exists:cotacao_frete,uf'],

            /**
             * - Obrigatório
             * - Campo numérico
             * - Deve ser maior que 0 (zero)
             */
            'valor_pedido' => ['required', 'numeric', 'not_in:0', 'min:0'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'uf.exists' => 'Cotação não cadastrada o UF',
        ];
    }
}
