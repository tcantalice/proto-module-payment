<?php

namespace App\Modules\Paginseguro;

use App\Contracts\Data\PaymentTransaction;
use App\Contracts\Services\PaymentMethod;
use App\Support\PaymentData;

class Paginseguro implements PaymentMethod
{
    public function __construct(private array $config)
    {
        //
    }

    public function authenticate()
    {
        //
    }

    public function pay(PaymentData $data): PaymentTransaction
    {
        return new PaginseguroTransaction();
    }

    public function updateStatus()
    {
        //
    }

    public function callbackUrl(string $reference): string
    {
        return route('paginseguro.status-hook', [
            "token" => $reference
        ]);
    }
}