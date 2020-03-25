<?php

namespace Marek\Covid19\Denormalizer;

use Marek\Covid19\API\Value\Response\CountrySummary;
use Marek\Covid19\API\Value\Response\Response;
use Marek\Covid19\API\Value\Response\Summary;

class SummaryDenormalizer extends AbstractDenormalizer
{
    public function denormalize(array $data, Response $response): Response
    {
        $summaries = [];
        foreach ($data['Countries'] as $summary) {
            $summaries[] = $this->denormalizer->denormalize($summary, CountrySummary::class, 'json');
        }

        $response->setData($summaries);

        return $response;
    }

    public function canDenormalize(array $data, Response $response): bool
    {
        return $response instanceof Summary;
    }
}
