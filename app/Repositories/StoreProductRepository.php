<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\StoreProduct;
use App\Repositories\Interfaces\IStoreProductRepo;

/**
 * Class StoreProductRepository
 * @package App\Repositories
 */
final class StoreProductRepository implements IStoreProductRepo
{

    public function __construct(private StoreProduct $storeProduct)
    {
    }

    /**
     * Creates array of storeProducts
     * @param array $storeProducts
     * @return bool
     */
    public function createStoreProducts(array $storeProducts): bool
    {
        return $this->storeProduct::insert($storeProducts);
    }
}
