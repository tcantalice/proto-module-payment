<?php

namespace App\Support;

use App\Entities\Cart;
use Carbon\Carbon;

class PaymentData
{
    public function __construct(
        private Cart $cart
    ) {
        //
    }

    public function getAmmount(): float
    {
        return $this->cart->getSubtotal();
    }

    public function getCreatedAt(): Carbon
    {
        return $this->cart->openedAt();
    }

    public function getCart(): Cart
    {
        return $this->cart;
    }
}