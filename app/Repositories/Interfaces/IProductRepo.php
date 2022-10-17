<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

use App\Dtos\Product\CreateProductDto;
use App\Models\Product;

interface IProductRepo
{
    public function createProduct(CreateProductDto $createProductDto): Product;

    public function deleteProduct(int $id): bool|null;

    public function getProductById(int $id): Product|null;

    public function getProductByIdAndUser(int $id, int $userId): Product|null;

    public function productsByIds(array $ids): array;
}
