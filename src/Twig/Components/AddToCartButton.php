<?php

namespace App\Twig\Components;

use App\Services\Cart;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\ComponentToolsTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
final class AddToCartButton
{
    use DefaultActionTrait;
    use ComponentToolsTrait;

    #[LiveProp]
    public int $productId;

    public function __construct(private Cart $cart)
    {
    }

    public function hasItem(): bool
    {
        return $this->cart->hasItem($this->productId);
    }

    #[LiveAction]
    public function add(): void
    {
        $this->cart->addItem($this->productId);
        $this->emit('cartUpdated');
    }

    #[LiveAction]
    public function remove(): void
    {
        $this->cart->removeItem($this->productId);
        $this->emit('cartUpdated');
    }
}
