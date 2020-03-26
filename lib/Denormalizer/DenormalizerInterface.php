<?php


namespace Marek\Covid19\Denormalizer;

use Marek\Covid19\API\Value\Response\Response;

interface DenormalizerInterface
{
    /**
     * Denormalizes a response.
     *
     * @param string $data
     * @param \Marek\Covid19\API\Value\Response\Response $response
     *
     * @return \Marek\Covid19\API\Value\Response\Response
     */
    public function denormalize(array $data, Response $response): Response;

    /**
     * Checks if provided data is valid for denormalization.
     *
     * @param array $data
     * @param \Marek\Covid19\API\Value\Response\Response $response
     *
     * @return \Marek\Covid19\API\Value\Response\Response
     */
    public function canDenormalize(array $data, Response $response): bool;
}
