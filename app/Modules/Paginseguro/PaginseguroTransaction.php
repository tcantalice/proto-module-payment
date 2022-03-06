<?php

namespace App\Modules\Paginseguro;

use App\Contracts\Data\PaymentTransaction;
use App\Enums\PaymentStatus;
use Carbon\Carbon;

class PaginseguroTransaction implements PaymentTransaction
{
    public function getAmmount(): float
    {
        return 0.0;
    }

    public function getPaymentLink(): ?string
    {
        return '';
    }

    public function getPaymentMethodIdentifier(): string
    {
        return '';
    }

    public function createdAt(): Carbon
    {
        return now();
    }

    public function getReference(): ?string
    {
        return '';
    }

    public function getStatus(): PaymentStatus
    {
        return PaymentStatus::Waiting;
    }
}