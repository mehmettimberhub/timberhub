<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Testing\TestResponse;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function ensureResponseStructure(TestResponse $response, bool $success = true): TestResponse
    {
        $decodeResponse = $response->json();

        $this->assertArrayHasKey('success', $decodeResponse);
        $this->assertArrayHasKey('messages', $decodeResponse);
        $this->assertArrayHasKey('data', $decodeResponse);

        $this->assertEquals($success, $decodeResponse['success']);

        return $response;
    }
}
