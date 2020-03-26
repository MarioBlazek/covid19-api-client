<?php

declare(strict_types=1);

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
     */
    public function __construct(InternalDenormalizer $denormalizer)
    {
        $this->denormalizer = $denormalizer;
    }
}
