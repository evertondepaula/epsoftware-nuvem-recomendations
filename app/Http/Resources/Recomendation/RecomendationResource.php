<?php

namespace Nuvem\Http\Resources\Recomendation;

use Illuminate\Http\Resources\Json\JsonResource;

class RecomendationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $item = $this->getItem();

        return [
            'sku'         => $item->getSku(),
            'name'        => $item->getName(),
            'count'       => $this->getCount(),
        ];
    }
}
