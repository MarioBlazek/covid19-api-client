<?php

namespace Marek\Covid19\Denormalizer;

use Marek\Covid19\API\Value\Response\CountryReport;
use Marek\Covid19\API\Value\Response\Report;
use Marek\Covid19\API\Value\Response\Response;

class ReportDenormalizer extends AbstractDenormalizer
{
    public function denormalize(array $data, Response $response): Response
    {
        $reports = [];
        foreach ($data as $report) {
            $reports[] = $this->denormalizer->denormalize($report, CountryReport::class, 'json');
        }

        $response->setData($reports);

        return $response;
    }

    public function canDenormalize(array $data, Response $response): bool
    {
        return $response instanceof Report;
    }
}
