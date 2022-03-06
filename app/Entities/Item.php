<?php

namespace App\Entities;

use Illuminate\Support\Arr;

class Item
{
    public function __construct(
        private string $description,
        private int $quantity,
        private float $unitValue,
    ) {
        //
    }

    public static function fromArray(array $data)
    {
        return new static(
            Arr::get($data, 'descricao', Arr::get($data, 'description')),
            Arr::get($data, 'quantidade', Arr::get($data, 'quantity')),
            Arr::get($data, 'valor_unitario', Arr::get($data, 'unit_value')),
        );
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getSubtotal()
    {
        return $this->getQuantity() * $this->getUnitValue();
    }

    public function getUnitValue()
    {
        return $this->unitValue;
    }
}