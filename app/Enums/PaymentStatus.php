<?php

namespace App\Enums;

enum PaymentStatus: int
{
    case Waiting = 1;
    case Cancelled = 2;
    case Revoked = 3;
    case Paid = 4;
}