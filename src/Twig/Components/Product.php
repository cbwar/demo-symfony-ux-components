<?php

namespace App\Twig\Components;

use App\Entity\Product as Entity;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
final class Product
{
    public Entity $product;

}
