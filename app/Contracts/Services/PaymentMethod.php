<?php

namespace App\Contracts\Services;

use App\Contracts\Data\PaymentTransaction;
use App\Enums\PaymentStatus;
use App\Support\PaymentData;

interface PaymentMethod
{
    public function authenticate();

    public function pay(PaymentData $data): PaymentTransaction;

    public function updateStatus();

    public function callbackUrl(string $reference): string;
}