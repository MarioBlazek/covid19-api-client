<?php

namespace Marek\Covid19\Tests\Unit\Core\Http\Client;

use Marek\Covid19\Core\Http\Client\SymfonyHttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;
use PHPUnit\Framework\TestCase;

class SymfonyHttpClientTest extends TestCase
{
    public function testMinimalHttpClient()
    {
        $symfonyHttpClient = $this->createMock(HttpClientInterface::class);
        $response = $this->createMock(ResponseInterface::class);

        $url = 'http://example.com/endpoint';
        $statusCode = 400;
        $content = file_get_contents(__DIR__ . '/../../../../Integration/countries.json');
        $client = new SymfonyHttpClient($symfonyHttpClient);

        $symfonyHttpClient->expects($this->once())
            ->method('request')
            ->with('GET', $url)
            ->willReturn($response);

        $response->expects($this->once())
            ->method('getContent')
            ->willReturn($content);

        $response->expects($this->once())
            ->method('getStatusCode')
            ->willReturn($statusCode);

        $result = $client->get('http://example.com/endpoint');

        $this->assertEquals($statusCode, $result->getStatusCode());
        $this->assertFalse($result->isOk());
        $this->assertEquals(json_decode($content, true), $result->getData());
    }
}
