<?php

declare(strict_types=1);

namespace App\Http\Resources\Product;

use App\Http\Resources\BaseJsonResource;

class StoreProductsResource extends BaseJsonResource
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
            'product_id' => $this->product_id,
            'store_id' => $this->store_id,
            'price' => $this->price,
        ];
    }
}
