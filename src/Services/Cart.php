<?php

namespace App\Services;

class Cart
{

    private array $items = [];

    public function addItem(string $productId, int $quantity = 1): void
    {
        if (isset($this->items[$productId])) {
            $this->items[$productId] += $quantity;
        } else {
            $this->items[$productId] = $quantity;
        }
    }

    public function removeItem(string $productId): void
    {
        unset($this->items[$productId]);
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function clear(): void
    {
        $this->items = [];
    }

}
