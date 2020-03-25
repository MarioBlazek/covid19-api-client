<?php

namespace Marek\Covid19\Core\Factory;

use Marek\Covid19\Denormalizer\CountriesDenormalizer;
use Marek\Covid19\Denormalizer\DenormalizerAggregate;
use Marek\Covid19\Denormalizer\ReportDenormalizer;
use Marek\Covid19\Denormalizer\SummaryDenormalizer;

class DenormalizerFactory
{
    public function create()
    {
        $serializerFactory = new SerializerFactory();
        $serializer = $serializerFactory->create();

        $denormalizers = [
            new SummaryDenormalizer($serializer),
            new ReportDenormalizer($serializer),
            new CountriesDenormalizer($serializer),
        ];

        return new DenormalizerAggregate($denormalizers);
    }
}
