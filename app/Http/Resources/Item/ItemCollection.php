<?php

namespace Nuvem\Http\Resources\Item;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Nuvem\Http\Resources\Item\ItemResource;

class ItemCollection extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($item) {
            return new ItemResource($item);
        });
    }
}
