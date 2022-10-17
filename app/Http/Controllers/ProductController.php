<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Dtos\Product\CreateProductDto;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\DeleteProductRequest;
use App\Http\Resources\Product\ProductResource;
use App\Services\Interfaces\IProductService;
use App\Services\Interfaces\IStoreService;
use App\Services\ResponseService;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class ProductController extends BaseController
{

    public function __construct(
        private ResponseService $responseService,
        private IStoreService $storeService,
        private IProductService $productService
    ) {
    }

    /**
     * create Product
     * @param CreateProductRequest $request
     * @return \App\Services\Illuminate\Http\Response
     * @throws \App\Exceptions\ApplicationException
     */
    public function createProduct(CreateProductRequest $request)
    {
        $product = $this->storeService->createStoreProduct(new CreateProductDto(
            Auth::user()->id,
            (array)$request->input('store_products'),
            $request->input('name'),
        ));
        return $this->responseService->getSuccessResponse(new ProductResource($product));
    }



    //  /**
    //  * delete Product
    //  * @param DeleteProductRequest $request
    //  * @return \App\Services\Illuminate\Http\Response
    //  * @throws \App\Exceptions\ApplicationException
    //  */
    public function deleteProduct(DeleteProductRequest $request, int $id)
    {
        return $this->responseService->getSuccessResponse($this->productService->deleteProduct($id, Auth::user()->id));
    }
}
