<?php

declare(strict_types=1);

namespace App\Services;

use App\Constants\Error;
use App\Dtos\Product\CreateProductDto;
use App\Exceptions\ApplicationException;
use App\Models\Product;
use App\Repositories\Interfaces\IProductRepo;
use App\Repositories\Interfaces\IDbTransaction;
use App\Repositories\Interfaces\IStoreProductRepo;
use App\Services\Interfaces\IProductService;


/**
 * Class ProductService
 * @package App\Services
 */
final class ProductService implements IProductService
{

    public function __construct(
        private IProductRepo $productRepo,
        private IStoreProductRepo $storeProductRepo,
        private IDbTransaction $dbTransaction
    ) {
    }

    /**
     * @param CreateProductDto $createProducDto
     * @return Product
     * @throws ApplicationException
     */
    public function createProduct(CreateProductDto $createProducDto): Product|null
    {
        $product = null;
        $this->dbTransaction->createTransaction(function () use ($createProducDto, &$product) {
            $product = $this->productRepo->createProduct($createProducDto);
            $this->storeProductRepo->createStoreProducts($createProducDto->getStoreProducts($product->id));
        });
        return $product;
    }


    public function getProductById(int $id): Product|null
    {
        $product = $this->productRepo->getProductById($id);
        if (is_null($product)) {
            throw new ApplicationException(Error::PRODUCT_NOT_FOUND->value);
        }
        return $product;
    }

    public function deleteProduct(int $id, int $userId): bool|null
    {
        $this->getProductById($id);
        $product = $this->productRepo->getProductByIdAndUser($id, $userId);
        if (is_null($product)) {
            throw new ApplicationException(Error::PRODUCT_NOT_BELONG_TO_USER->value);
        }
        return $this->productRepo->deleteProduct($id);
    }
}
