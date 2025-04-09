<?php

namespace App\Repository;

use App\Entity\Product;
use Random\RandomException;

class ProductRepository
{
    /**
     * @return Product[]
     * @throws RandomException
     */
    public function findAll(): array
    {
        // Generate random products for demonstration purposes
        $products = [];
        for ($i = 1; $i <= 10; $i++) {
            $product = new Product();
            $product->setId($i);
            $product->setName('Product ' . $i);
            $product->setPrice(random_int(10, 100));
            $product->setDescription('Description for product ' . $i);
            $product->setImage('https://picsum.photos/200');
            $products[] = $product;
        }
        return $products;
    }
}
