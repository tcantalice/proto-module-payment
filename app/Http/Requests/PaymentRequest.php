<?php

namespace App\Http\Requests;

use App\Entities\Cart;
use App\Entities\Item;
use App\Support\PaymentData;
use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
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
            'abertura' => 'required|datetime:Y-m-d\TH:i:s\Z',
            'metodo_pagamento' => 'required|string|exists:metodo_pagamento,nome',
            'itens' => 'required|array|filled',
            'itens.*' => 'json',
            'itens.*.descricao' => 'required|string',
            'itens.*.valor_unitario' => 'required|numeric|min:1',
            'itens.*.quantidade' => 'required|integer|min:1'
        ];
    }

    public function getMetodoPagamento()
    {
        return $this->input('metodo_pagamento');
    }

    public function getPaymentData(): PaymentData
    {
        $items = collect($this->inpu('itens'))->map(function ($itemData) {
            return Item::fromArray($itemData);
        })->toArray();

        $cart = new Cart(
            $this->input('abertura'),
            $items,
        );

        return new PaymentData($cart);
    }
}
