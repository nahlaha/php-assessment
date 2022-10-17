<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Dtos\Product\CreateProductDto;
use App\Models\Product;
use App\Repositories\Interfaces\IProductRepo;

/**
 * Class ProductRepository
 * @package App\Repositories
 */
final class ProductRepository implements IProductRepo
{

    public function __construct(private Product $product)
    {
    }

    /**
     * Creates a new Product
     * @param CreateProductDto $createProductDto
     * @return Product
     */
    public function createProduct(CreateProductDto $createProductDto): Product
    {
        $this->product->name = $createProductDto->name;
        $this->product->save();
        return $this->product;
    }

    /**
     * delete a product
     */
    public function deleteProduct(int $id): bool|null
    {
        return $this->product->query()->find($id)->delete();
    }

    public function getProductById(int $id): Product|null
    {
        return $this->product->query()->find($id);
    }


    public function getProductByIdAndUser(int $id, int $userId):Product|null
    {
        return $this->product->query()->where('id', $id)->whereHas('storeProducts', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->first();
    }

    public function productsByIds(array $ids): array
    {
        return $this->product::query()->whereIn('id', $ids)
            ->get()
            ->map(function ($product) {
                return [
                    'id' => $product['id'],
                    'name' => $product['name']
                ];
            })->toArray();
    }
}
