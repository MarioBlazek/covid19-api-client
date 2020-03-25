<?php

namespace Marek\Covid19\Denormalizer;

use Symfony\Component\Serializer\Normalizer\DenormalizerInterface as InternalDenormalizer;

abstract class AbstractDenormalizer implements DenormalizerInterface
{
    /**
     * @var \Symfony\Component\Serializer\Normalizer\DenormalizerInterface
     */
    protected $denormalizer;

    /**
     * AbstractDenormalizer constructor.
     *
     * @param \Symfony\Component\Serializer\Normalizer\DenormalizerInterface $denormalizer
     */
    public function __construct(InternalDenormalizer $denormalizer)
    {
        $this->denormalizer = $denormalizer;
    }
}
