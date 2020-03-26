<?php

declare(strict_types=1);

namespace Marek\Covid19\Core\Http\Client;

use Marek\Covid19\API\Http\Client\HttpClientInterface;
use Marek\Covid19\API\Http\Response\ResponseInterface;
use Marek\Covid19\Core\Http\Response\JsonResponse;
use Symfony\Contracts\HttpClient\HttpClientInterface as BaseHttpClientInterface;

final class SymfonyHttpClient implements HttpClientInterface
{
    /**
     * @var \Symfony\Contracts\HttpClient\HttpClientInterface
     */
    private $innerClient;

    public function __construct(BaseHttpClientInterface $innerClient)
    {
        $this->innerClient = $innerClient;
    }

    public function get(string $url): ResponseInterface
    {
        $response = $this->innerClient->request('GET', $url);

        return new JsonResponse(
            $response->getContent(),
            $response->getStatusCode()
        );
    }
}
