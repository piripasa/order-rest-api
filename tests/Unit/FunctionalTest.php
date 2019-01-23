<?php

namespace Tests\Unit;

use Tests\TestCase;

class FunctionalTest extends TestCase
{

    public function setUp()
    {
        parent::setUp();
    }

    /**
     * Check if DB server running
     */
    public function testDatabaseConnection()
    {
        $this->assertTrue(app('db')->getDatabaseName()?true:false);

    }

    /**
     * Check if env contain google map key
     */
    public function testGoogleMapKey()
    {

        $this->assertTrue(env('GOOGLE_MAP_API_KEY')?true:false);

    }

}
