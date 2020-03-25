<?php

namespace Marek\Covid19\Denormalizer;

use Marek\Covid19\API\Value\Response\Country;
use Marek\Covid19\API\Value\Response\Countries;
use Marek\Covid19\API\Value\Response\CountrySummary;
use Marek\Covid19\API\Value\Response\Response;

class CountriesDenormalizer extends AbstractDenormalizer
{
    public function denormalize(array $data, Response $response): Response
    {
        $countries = [];
        foreach ($data as $country) {
            $countries[] = $this->denormalizer->denormalize($country, Country::class, 'json');
        }

        $response->setData($countries);

        return $response;
    }

    public function canDenormalize(array $data, Response $response): bool
    {
        return $response instanceof Countries;
    }
}
