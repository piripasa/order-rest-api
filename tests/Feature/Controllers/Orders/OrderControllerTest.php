<?php
namespace Tests\Feature\Controllers\Orders;

use Tests\Feature\CrudTest;
use Faker\Factory;

class OrderControllerTest extends CrudTest
{
    protected $endPoint = "orders";

    public function testIDProvider()
    {
        $order = factory(\App\Models\Order::class)->create();

        $this->assertTrue($order->id > 0);

        return $order->id;
    }

    public function paramProvider()
    {
        $faker = Factory::create();
        return [
            [
                [
                    'origin' => [23.7948049,90.411659],
                    'destination' => [23.7746179,90.363315]
                ]
            ]
        ];
    }
}
