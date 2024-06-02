<?php

namespace Nuvem\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Nuvem\Http\Resources\Recomendation\RecomendationCollection;
use Nuvem\Http\Requests\Recomendation as Requests;
use Nuvem\Services\RecomendationManager;

class RecomendationController extends Controller
{
    /**
     * @var RecomendationManager
     */
    private $service;

    public function __construct(RecomendationManager $service)
    {
        $this->service = $service;
    }

    public function getBySku(string $sku, Requests\Get $request)
    {
        $items = $this->service->get($sku, $request->all());

        return (new RecomendationCollection($items))->response()->setStatusCode(Response::HTTP_OK);
    }
}
