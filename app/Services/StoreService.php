<?php

declare(strict_types=1);

namespace App\Services;

use App\Constants\Error;
use App\Dtos\Product\CreateProductDto;
use App\Dtos\Store\CreateStoreDto;
use App\Exceptions\ApplicationException;
use App\Models\Product;
use App\Models\Store;
use App\Repositories\Interfaces\IStoreRepo;
use App\Services\Interfaces\IProductService;
use App\Services\Interfaces\IStoreService;
use PHPUnit\Framework\Constraint\Count;

/**
 * Class StoreService
 * @package App\Services
 */
final class StoreService implements IStoreService
{

    public function __construct(private IStoreRepo $storeRepo, private IProductService $productService)
    {
    }

    /**
     * @param CreateStoreDto $createStoreDto
     * @return Store
     * @throws ApplicationException
     */
    public function createStore(CreateStoreDto $createStoreDto): Store
    {
        $store = $this->storeRepo->getStoreByNameAndUser($createStoreDto->name, $createStoreDto->userId);
        if (!is_null($store)) {
            throw new ApplicationException(Error::STORE_NAME_ALREADY_EXISTS->value);
        }
        return $this->storeRepo->createStore($createStoreDto);
    }


    /**
     * @param CreateProductDto $createProductDto
     * @return Product|null
     * @throws ApplicationException
     */
    public function createStoreProduct(CreateProductDto $createProductDto): Product|null
    {
        // check all stores belong to user
        $storesIds = array_column($createProductDto->storeProducts, 'store_id');
        $count = $this->storeRepo->countStoreByIdsAndUser($createProductDto->userId, $storesIds);
        if ($count === 0 || $count < Count($storesIds)) {
            throw new ApplicationException(Error::STORE_NOT_BELONG_TO_USER->value);
        }
        return $this->productService->createProduct($createProductDto);
    }
}
