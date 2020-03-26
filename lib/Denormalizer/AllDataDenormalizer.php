<?php

namespace Marek\Covid19\Denormalizer;

use Marek\Covid19\API\Value\Response\AllData;
use Marek\Covid19\API\Value\Response\Response;

class AllDataDenormalizer extends ReportDenormalizer
{
    public function canDenormalize(array $data, Response $response): bool
    {
        return $response instanceof AllData;
    }
}
