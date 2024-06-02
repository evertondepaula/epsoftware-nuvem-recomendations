<?php

namespace Nuvem\Services;

use Nuvem\Documents\Order;
use Nuvem\Documents\Item;
use DocumentManager;
use DateTime;

class OrderManager
{
    public function create(array $params): Order
    {
        $order = new Order;

        $order->setNumber(array_get($params, 'number'))
              ->setCreatedAt(new DateTime(array_get($params, 'created_at')));

        $items = array_get($params, 'items');

        foreach ($items as $item) {
            $itemEntity = new Item;
            $itemEntity->setSku(array_get($item, 'sku'))
                       ->setName(array_get($item, 'name'))
                       ->setQuantity(array_get($item, 'quantity'))
                       ->setUnitValue(array_get($item, 'unit_value'))
                       ->setCreatedAt(new DateTime(array_get($item, 'created_at')));

            $order->addItem($itemEntity);

            DocumentManager::persist($itemEntity);
        }

        DocumentManager::persist($order);
        DocumentManager::flush();

        return $order;
    }
}
