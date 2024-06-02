<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use MongoConnection;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public $database;
    public $collection;

    public function setUp()
    {
        parent::setUp();
        $this->database = env('MONGO_DATABASE', 'interview_testing');
        MongoConnection::getClient()->{$this->database}->{$this->collection}->drop();
    }

    public function tearDown()
    {
        parent::tearDown();
        MongoConnection::getClient()->{$this->database}->{$this->collection}->drop();
    }
}
