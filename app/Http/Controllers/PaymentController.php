<?php

namespace App\Http\Controllers;

use App\Contracts\Services\PaymentMethod;
use App\Http\Requests\PaymentRequest;
use App\Support\PaymentData;
use Illuminate\Support\Facades\App;

class PaymentController extends Controller
{
    public function makePayment(PaymentRequest $request)
    {
        $paymentMethod = $request->getMetodoPagamento();
        $paymentData = $request->getPaymentData();

        /**
         * @var PaymentMethod
         */
        $service = App::make(PaymentMethod::class, [$paymentMethod]);

        $service->authenticate();

        $service->pay($paymentData);
    }
}
