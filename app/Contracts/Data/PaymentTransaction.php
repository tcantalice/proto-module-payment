<?php

namespace App\Contracts\Data;

use App\Enums\PaymentStatus;
use Carbon\Carbon;

interface PaymentTransaction
{
    public function getStatus(): PaymentStatus;

    public function getReference(): ?string;

    public function getAmmount(): float;

    public function createdAt(): Carbon;

    public function getPaymentMethodIdentifier(): string;

    public function getPaymentLink(): ?string;
}