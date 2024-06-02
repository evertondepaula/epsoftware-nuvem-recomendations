<?php

namespace Nuvem\Repositories;

use DateTime;

class OrderRepository extends Repository
{
    public function countItemBySku(string $sku, DateTime $from, DateTime $to, int $limit = 10): ?array
    {
        $builder = $this->createAggregationBuilder();

        $items = $builder
                    ->hydrate(\Nuvem\Documents\Recomendation::class)
                    ->match()
                        ->field('createdAt')
                            ->gte($from)
                            ->lt($to)
                        ->field('items.sku')
                            ->equals($sku)
                    ->unwind('$items')
                    ->match()
                        ->field('items.sku')
                        ->notEqual($sku)
                    ->project()
                        ->excludeFields(['_id'])
                        ->field('sku')
                            ->expression('$items.sku')
                        ->field('name')
                            ->expression('$items.name')
                        ->group()
                            ->field('_id')
                                ->expression(
                                    $builder->expr()
                                        ->field('sku')
                                            ->expression('$sku')
                                    ->field('name')
                                        ->expression('$name')
                                )
                            ->field('count')
                                ->sum(1)
                    ->sort(['count' => -1])
                    ->limit($limit)
                    ->execute();

        return $items->toArray();
    }
}
