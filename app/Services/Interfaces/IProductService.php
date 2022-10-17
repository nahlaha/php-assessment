<?php

declare(strict_types=1);

namespace App\Services\Interfaces;

use App\Dtos\Product\CreateProductDto;
use App\Models\Product;

interface IProductService
{
    public function createProduct(CreateProductDto $createProductDto): Product|null;

    public function deleteProduct(int $id, int $userId): bool|null;

    public function getProductById(int $id): Product|null;
}
