<?php

namespace Marek\Covid19\Denormalizer;

use Marek\Covid19\API\Value\Response\Response;
use Marek\Covid19\API\Value\Response\Statistics;

class StatisticsDenormalizer extends AbstractDenormalizer
{
    public function denormalize(array $data, Response $response): Response
    {
        return $this->denormalizer->denormalize($data, Statistics::class);
    }

    public function canDenormalize(array $data, Response $response): bool
    {
        return $response instanceof Statistics;
    }
}
