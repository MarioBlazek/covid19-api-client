<?php

namespace Marek\Covid19\Tests\Unit\Core\Http\Response;

use PHPUnit\Framework\TestCase;
use Marek\Covid19\Core\Http\Response\JsonResponse;

class JsonResponseTest extends TestCase
{
    public function testWithOkResponse(): void
    {
        $json = '[{"Country":"United Kingdom","Province":"United Kingdom","Lat":55.3781,"Lon":-3.436,"Date":"2020-01-31T00:00:00Z","Cases":2,"Status":"confirmed"}]';

        $response = new JsonResponse($json, 200);

        self::assertEquals(200, $response->getStatusCode());
        self::assertTrue($response->isOk());
        self::assertEquals(json_decode($json, true), $response->getData());
        self::assertEquals($json, (string)$response);
    }

    public function testWithErrorResponse(): void
    {
        $json = '[{"Country":"United Kingdom","Province":"United Kingdom","Lat":55.3781,"Lon":-3.436,"Date":"2020-01-31T00:00:00Z","Cases":2,"Status":"confirmed"}]';

        $response = new JsonResponse($json, 400);

        self::assertEquals(400, $response->getStatusCode());
        self::assertFalse($response->isOk());
        self::assertEquals(json_decode($json, true), $response->getData());
        self::assertEquals($json, (string)$response);
    }
}
