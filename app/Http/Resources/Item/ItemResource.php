<?php

namespace Nuvem\Http\Resources\Item;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'sku'         => $this->getSku(),
            'name'        => $this->getName(),
            'quantity'    => $this->getQuantity(),
            'unit_value'  => $this->getUnitValue(),
            'total_value' => $this->getTotalValue(),
            'created_at'  => $this->getCreatedAt(),
        ];
    }
}
