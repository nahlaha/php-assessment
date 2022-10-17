<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

interface IStoreProductRepo
{
    public function createStoreProducts(array $storeProducts): bool;
}
