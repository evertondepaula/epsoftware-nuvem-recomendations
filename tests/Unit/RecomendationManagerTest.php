<?php

namespace Tests\Unit;

use Tests\TestCase;
use Nuvem\Services\OrderManager;
use Nuvem\Services\RecomendationManager;
use Illuminate\Database\Eloquent\Collection;

/**
 * @coversDefaultClass \Nuvem\Services\RecomendationManager
 */
class RecomendationManagerTest extends TestCase
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
     * @covers \Nuvem\Services\RecomendationManager::get
    */
    public function testGetRecomendation()
    {
        $orderManager = new OrderManager;
        $manager = new RecomendationManager;

        $order = $orderManager->create($this->params);

        $recomendations = $manager->get($this->params['items'][0]['sku'], ['limit' => 1, 'months' => 2]);

        $this->assertTrue($recomendations instanceof Collection);

        $this->assertTrue($recomendations->first()->getItem()->getSku() == $this->params['items'][1]['sku']);
    }

}
