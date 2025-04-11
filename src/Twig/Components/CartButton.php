<?php

namespace App\Twig\Components;

use App\Services\Cart;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveListener;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
final class CartButton
{
    use DefaultActionTrait;

    private int $productCount = 0;

    public function __construct(private Cart $cart)
    {
        $this->updateProductCount();
    }

    #[LiveListener('cartUpdated')]
    public function updateProductCount(): void
    {
        $this->productCount = $this->cart->count();
    }

    public function getItemCount(): int
    {
        return $this->productCount;
    }
}
