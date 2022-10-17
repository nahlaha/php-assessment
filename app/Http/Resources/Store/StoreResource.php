<?php

declare(strict_types=1);

namespace App\Http\Resources\Store;

use App\Http\Resources\BaseJsonResource;

class StoreResource extends BaseJsonResource
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
            'user_id' => $this->user_id
        ];
    }
}
