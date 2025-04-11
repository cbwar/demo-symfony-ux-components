<?php

namespace App\Twig\Components;

use App\Services\Cart;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
final class CartButton
{
    use DefaultActionTrait;

    public function __construct(private Cart $cart)
    {
    }

    public function getItemCount(): int
    {
        return $this->cart->count();
    }
}
