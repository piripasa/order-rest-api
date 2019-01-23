<?php

namespace Tests\Feature;

use Tests\TestCase;

abstract class CrudTest extends TestCase
{

    protected $endPoint;
    protected $apiBasePath = "api";

    public function setUp()
    {
        parent::setUp();
    }

    /**
     * @depends testIDProvider
     */
    public function testIndexAll()
    {
        $response = $this->call("GET",
            sprintf("%s/%s", $this->apiBasePath, $this->endPoint)
        )->getOriginalContent();

        $this->assertResponseOk();
        $this->assertResponseStatus(200);
        $this->assertTrue(is_array($response));
    }

    /**
     * @dataProvider paramProvider
     */
    public function testCreate($params)
    {
        $response = $this->call("POST",
            sprintf("%s/%s", $this->apiBasePath, $this->endPoint),
            $params
        )->getOriginalContent();
        $this->assertResponseOk();
        $this->assertResponseStatus(200);
        $this->assertEquals(ORDER_UNASSIGNED, $response['status']);
    }

    /**
     * @dataProvider paramProvider
     * @depends testIDProvider
     */
    public function testUpdate($params, $id)
    {
        $order = factory(\App\Models\Order::class)->create();
        $response = $this->call("PATCH",
            sprintf("%s/%s/%d", $this->apiBasePath, $this->endPoint, $order->id),
            ['status' => ORDER_TAKEN]
        )->getOriginalContent();
        $this->assertResponseOk();
        $this->assertResponseStatus(200);
        $this->assertEquals("SUCCESS", $response['status']);
    }
}
