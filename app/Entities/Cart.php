<?php

namespace App\Entities;

use Carbon\Carbon;

class Cart
{
    public function __construct(
        private string|Carbon $openTs,
        private array $items,
    ) {
        if (is_string($openTs)) {
            $this->openedTs = Carbon::createFromFormat('Y-m-d\TH:i:s\Z', $openTs);
        }
    }

    public function addItem(Item $item)
    {
        array_push($this->items, $item);
    }

    public function getSubtotal(): float
    {
        return collect($this->items)->sum(function (Item $item) {
            return $item->getSubtotal();
        });
    }

    public function openedAt(): Carbon
    {
        return $this->openTs;
    }
}