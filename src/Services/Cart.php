<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\RequestStack;

class Cart
{

    private array $items;

    public function __construct(private readonly RequestStack $requestStack)
    {
        $this->load();
    }

    private function save(): void
    {
        $this->requestStack->getSession()->set('cart', $this->items);
    }

    private function load(): void
    {
        $this->items = $this->requestStack->getSession()->get('cart', []);
    }

    public function addItem(string $productId, int $quantity = 1): void
    {
        if (isset($this->items[$productId])) {
            $this->items[$productId] += $quantity;
        } else {
            $this->items[$productId] = $quantity;
        }
        $this->save();
    }

    public function removeItem(string $productId): void
    {
        unset($this->items[$productId]);
        $this->save();
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function hasItem(string $productId): bool
    {
        return isset($this->items[$productId]);
    }

    public function clear(): void
    {
        $this->items = [];
        $this->save();
    }

    public function count(): int
    {
        return count($this->items);
    }
}
