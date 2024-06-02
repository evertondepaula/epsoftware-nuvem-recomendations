<?php

namespace Nuvem\Http\Resources\Order;

use Illuminate\Http\Resources\Json\JsonResource;
use Nuvem\Http\Resources\Item\ItemCollection;
use Illuminate\Database\Eloquent\Collection;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $items = new Collection($this->getItems()->getValues());

        return [
            'id'          => $this->getId(),
            'number'      => $this->getNumber(),
            'total_value' => $this->getTotalValue(),
            'created_at'  => $this->getCreatedAt(),
            'items'       => new ItemCollection($items),
        ];
    }
}
