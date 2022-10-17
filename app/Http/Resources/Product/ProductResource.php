<?php

declare(strict_types=1);

namespace App\Http\Resources\Product;

use App\Http\Resources\BaseJsonResource;

class ProductResource extends BaseJsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'store_products' => StoreProductsResource::collection($this->whenLoaded('storeProducts'))

        ];
    }
}
