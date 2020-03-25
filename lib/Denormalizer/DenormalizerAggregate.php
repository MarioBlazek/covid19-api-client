<?php

namespace Marek\Covid19\Denormalizer;

use Marek\Covid19\API\Value\Response\Response;

class DenormalizerAggregate implements DenormalizerInterface
{
    /**
     * @var DenormalizerInterface[]
     */
    private $denormalizers;

    public function __construct(array $denormalizers)
    {
        $this->denormalizers = $denormalizers;
    }

    public function denormalize(array $data, Response $response): Response
    {
        /** @var DenormalizerInterface $denormalizer */
        foreach ($this->denormalizers as $denormalizer) {

            if ($denormalizer->canDenormalize($data, $response)) {
                return $denormalizer->denormalize($data, $response);
            }

//            throw new \RuntimeException('There is no any valid denormalizers available.');
        }
    }

    public function canDenormalize(array $data, Response $response): bool
    {
        return true;
    }
}
