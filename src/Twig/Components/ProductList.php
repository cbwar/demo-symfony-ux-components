<?php

namespace App\Twig\Components;

use App\Repository\ProductRepository;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
final class ProductList
{
    public function __construct(private ProductRepository $productRepository)
    {
    }

    public function getProducts(): array
    {
        return $this->productRepository->findAll();
    }
}
