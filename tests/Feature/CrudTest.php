<?php

namespace Tests\Feature;

use Laravel\Lumen\Testing\DatabaseTransactions;
use Tests\TestCase;

abstract class CrudTest extends TestCase
{
    use DatabaseTransactions;

    protected $endPoint;
    protected $apiBasePath = "api";

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
     * @param $params
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
     * @param $params
     * @param $id
     */
    public function testUpdate($params, $id)
    {
        $response = $this->call("PATCH",
            sprintf("%s/%s/%d", $this->apiBasePath, $this->endPoint, $id),
            ['status' => ORDER_TAKEN]
        )->getOriginalContent();
        $this->assertResponseOk();
        $this->assertResponseStatus(200);
        $this->assertEquals("SUCCESS", $response['status']);
    }
}
