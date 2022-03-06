<?php

namespace App\Modules\Paginseguro;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class PaginseguroServiceProvider extends ServiceProvider
{
    protected $name = 'paginseguro';

    protected $description = 'PagInSeguro';

    protected $namespace = 'App\\Modules\\Paginseguro';

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerService();
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/migrations');
        $this->loadRoutesFrom(__DIR__.'/routes/api.php');

        $this->registerMethodDatabase();
    }

    protected function getSignatureService()
    {
        return implode('.', ['payment', $this->name]);
    }

    protected function getConfigKey()
    {
        return implode('.', ['payments', $this->name]);
    }

    protected function config()
    {
        return config($this->getConfigKey());
    }

    protected function sandbox()
    {
        return Arr::get($this->config(), 'sandbox');
    }

    protected function production()
    {
        return Arr::get($this->config(), 'production');
    }

    protected function registerMethodDatabase()
    {
        $tuple = DB::table('metodo_pagamento')->where('nome', $this->name)
            ->first();

        if (!$tuple) {
            $dbIdentifier = DB::table('metodo_pagamento')->insertGetId([
                "nome" => $this->name,
                "descricao" => $this->description
            ]);
        } else {
            $dbIdentifier = $tuple->id;
        }

        Cache::forever(implode('.', ['payment', $this->name, 'id']), $dbIdentifier);
    }

    protected function registerService()
    {
        $config = $this->app->environment('local', 'development', 'test')
            ? $this->sandbox()
            : $this->production();
        
        $serviceInstance = new Paginseguro($config);

        $this->app->instance('payment.paginseguro', $serviceInstance);
    }
}
