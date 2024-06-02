<?php

namespace Tests\Feature;

use Tests\TestCase;
use Nuvem\Services\OrderManager;

class RecomendationTest extends TestCase
{
    public $collection = 'Order';

    private $params = [
        0 => [
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
                2 => [
                    'sku'        => 'RTYP11002',
                    'name'       => 'Camisa',
                    'quantity'   => 1,
                    'unit_value' => 10.00,
                    'created_at' => '2018-10-01 08:10:22'
                ],
            ]
        ],
        1 => [
            'number'     => 000002,
            'created_at' => '2018-10-02 08:10:22',
            'items'      => [
                0 => [
                    'sku'        => 'RTYP11003',
                    'name'       => 'Carteira',
                    'quantity'   => 1,
                    'unit_value' => 10.00,
                    'created_at' => '2018-10-02 08:10:22'
                ]
            ]
        ],
        2 => [
            'number'     => 000003,
            'created_at' => '2018-10-03 08:10:22',
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
        ]

    ];

    public function setUp()
    {
        parent::setUp();

        $manager = new OrderManager;

        foreach ($this->params as $param) {
            $manager->create($param);
        }
    }

    /**
     * Valid response body to get recomendations test.
     *
     * @return void
    */
    public function testGetRecomendationBody()
    {
        $response = $this->get('/recomendations/RTYP11000');
        $data = json_decode($response->content());

        $response->assertStatus(200);

        $this->assertTrue(property_exists($data, 'data'));
        $this->assertTrue(is_array($data->data));
        $this->assertTrue(property_exists($data->data[0], 'sku'));
        $this->assertTrue(property_exists($data->data[0], 'name'));
    }

    /**
     * Empty recomendation
     *
     * @return void
    */
    public function testGetEmptyRecomendation()
    {
        $response = $this->get('/recomendations/RTYP11003');
        $data = json_decode($response->content());

        $this->assertTrue(property_exists($data, 'data'));
        $this->assertTrue(is_array($data->data));
        $this->assertTrue(empty($data->data));
    }

    /**
     * Get recomendation one recomendations
     *
     * @return void
    */
    public function testGetOneRecomendation()
    {
        $response = $this->get('/recomendations/RTYP11000?limit=1');
        $data = json_decode($response->content());

        $this->assertTrue(property_exists($data, 'data'));
        $this->assertTrue(is_array($data->data));
        $this->assertTrue(count($data->data) == 1);
        $this->assertTrue($data->data[0]->sku == 'RTYP11001');
    }
}
