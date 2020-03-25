<?php

namespace Marek\Covid19\API\Http\Client;

use Marek\Covid19\API\Http\Response\ResponseInterface;

interface HttpClientInterface
{
    /**
     * Performs get request to given URL.
     *
     * @param string $url
     *
     * @return \Marek\Covid19\API\Http\Response\ResponseInterface
     */
    public function get(string $url): ResponseInterface;
}
