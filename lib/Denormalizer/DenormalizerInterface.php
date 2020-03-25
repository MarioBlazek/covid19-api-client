<?php


namespace Marek\Covid19\Denormalizer;

use Marek\Covid19\API\Value\Response\Response;

interface DenormalizerInterface
{
    /**
     * Denormalizes a response.
     *
     * @param array $data
     * @param \Marek\Covid19\API\Value\Response\Response $response
     *
     * @return \Marek\Covid19\API\Value\Response\Response
     */
    public function denormalize(array $data, Response $response): Response;
}
