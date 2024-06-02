<?php

namespace Tests\Unit;

use Tests\TestCase;
use Nuvem\Services\OrderManager;
use Nuvem\Documents\Order;

/**
 * @coversDefaultClass \Nuvem\Services\OrderManager
 */
class OrderManagerTest extends TestCase
{
    public $collection = 'Order';

    private $params = [
        'number'     => 000001,
        'created_at' => '2018-10-01 08:10:22',
        'items'      => [
            0 => [
                'sku'        => 'RTYP11000',
                'name'       => 'Chuteira',
                'quantity'   => 1,
                'unit_value' => 10.00,
                'created_at' => '2018-10-01 08:10:22'
            ],
            1 => [
                'sku'        => 'RTYP11001',
                'name'       => 'Bola de futebol',
                'quantity'   => 1,
                'unit_value' => 10.00,
                'created_at' => '2018-10-01 08:10:22'
            ],
        ]
    ];

    /**
     * @covers \Nuvem\Services\OrderManager::create
    */
    public function testOrderCreate()
    {
        $manager = new OrderManager;

        $order = $manager->create($this->params);

        $this->assertTrue($order instanceof Order);
    }

    /**
     * @covers \Nuvem\Services\OrderManager::create
    */
    public function testSumOrderCreated()
    {
        $manager = new OrderManager;

        $order = $manager->create($this->params);

        $total = $order->getTotalValue();
        $itemsTotal = 0.00;

        foreach ($this->params['items'] as $item) {
            $itemsTotal += $item['quantity'] * $item['unit_value'];
        }

        $this->assertTrue($itemsTotal == $total);
    }
}
