<?php

namespace App\Providers;

use App\Contracts\Services\PaymentMethod;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PaymentMethod::class, function (Application $app, array $args) {
            $method = $args[0] ?? null;

            $instance = null;

            if ($method) {
                $component = implode('.', ['payment', $method]);
                $config = config(implode('.', ['payments.', $method]));

                try {
                    $instance = $app->make($component, $config);

                    if (!($instance instanceof PaymentMethod)) {
                        $instance = null;
                    }
                } catch(BindingResolutionException $bre) {
                    $instance = null;
                }
            }
            
            return $instance;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
