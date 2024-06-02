<?php

namespace Tests\Feature;

use Tests\TestCase;

class OrderTest extends TestCase
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
     * Invalid body to create order test.
     *
     * @return void
     */
    public function testCreateOrderInvalidBody()
    {
        $response = $this->post('/orders', []);
        $data = json_decode($response->content());

        $response->assertStatus(422);

        $this->assertTrue(property_exists($data, 'errors'));
    }

    /**
     * A create reponse format
     *
     * @return void
    */
    public function testCreateOrder()
    {
        $response = $this->post('/orders', $this->params);
        $data = json_decode($response->content());

        $response->assertStatus(201);
        $this->assertTrue(property_exists($data, 'data'));
        $this->assertTrue(property_exists($data->data, 'number'));
        $this->assertTrue(property_exists($data->data, 'items'));
    }
}
