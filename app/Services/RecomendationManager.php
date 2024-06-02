<?php

namespace Nuvem\Services;

use Illuminate\Database\Eloquent\Collection;
use Nuvem\Documents\Order;
use DocumentManager;
use DateTime;

class RecomendationManager
{
    public function get(string $sku, array $params): ?Collection
    {
        $limit  = (int) array_get($params, 'limit', '10');
        $months = (int) array_get($params, 'months', '2');
        $to     = new DateTime;
        $from   = (new DateTime)->modify("-{$months} months");

        $recomendations = DocumentManager::getRepository(Order::class)->countItemBySku($sku, $from, $to, $limit);

        $collection = new Collection($recomendations);

        return $collection;
    }
}
