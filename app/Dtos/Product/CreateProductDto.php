<?php

declare(strict_types=1);

namespace App\Dtos\Product;

final class CreateProductDto
{

    public function __construct(
        public int $userId,
        public array $storeProducts,
        public string $name,
    ) {
    }

    public function getStoreProducts(int $productId): array
    {
        $storeProducts = [];
        foreach ($this->storeProducts as $value) {
            $storeProduct['product_id'] = $productId;
            $storeProduct['price'] = $value['price'];
            $storeProduct['store_id'] = $value['store_id'];
            array_push($storeProducts, $storeProduct);
        }
        return $storeProducts;
    }
}
