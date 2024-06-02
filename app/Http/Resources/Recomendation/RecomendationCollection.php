<?php

namespace Nuvem\Http\Resources\Recomendation;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Nuvem\Http\Resources\Recomendation\RecomendationResource;

class RecomendationCollection extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($recomendation) {
            return new RecomendationResource($recomendation);
        });
    }
}
