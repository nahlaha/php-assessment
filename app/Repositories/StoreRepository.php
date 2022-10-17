<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Dtos\Store\CreateStoreDto;
use App\Models\Store;
use App\Repositories\Interfaces\IStoreRepo;

/**
 * Class StoreRepository
 * @package App\Repositories
 */
final class StoreRepository implements IStoreRepo
{
    public function __construct(private Store $store)
    {
    }
    /**
     * Creates a new store
     * @param CreateStoreDto $createStoreDto
     * @return Store
     */
    public function createStore(CreateStoreDto $createStoreDto): Store
    {
        $this->store->name = $createStoreDto->name;
        $this->store->shipping_cost = $createStoreDto->shippingCost;
        $this->store->vat_type_id = $createStoreDto->vatType;
        $this->store->vat_value = $createStoreDto->vatValue;
        $this->store->user_id = $createStoreDto->userId;
        $this->store->save();
        return $this->store;
    }

    /**
     * get unique store by name and user id
     * @param string $name
     * @param int $userId
     * @return Store
     */
    public function getStoreByNameAndUser(string $name, int $userId): Store|null
    {
        return $this->store->whereRaw("lower(name) = (?)", strtolower($name))->where('user_id', $userId)->first();
    }

    /**
     * get store by id
     * @param int $id
     * @return Store
     */
    public function getStoreById(int $id): Store|null
    {
        return $this->store->find($id);
    }


    /**
     * @param int $userId
     * @param array $ids
     * @return int
     */
    public function countStoreByIdsAndUser(int $userId, array $ids): int
    {
        return $this->store->query()->where('user_id', $userId)->whereIn('id', $ids)->count();
    }
}
