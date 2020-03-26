<?php

declare(strict_types=1);

namespace Marek\Covid19\API\Http\Client;

use Marek\Covid19\API\Http\Response\ResponseInterface;

interface HttpClientInterface
{
    /**
     * Performs get request to given URL.
     */
    public function get(string $url): ResponseInterface;
}
