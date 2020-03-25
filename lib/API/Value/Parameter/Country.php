<?php

namespace Marek\Covid19\API\Value\Parameter;

class Country implements UriParameterInterface
{
    /**
     * @var string
     */
    protected $country;

    public function __construct(string $country)
    {
        $this->country = $country;
    }

    public function getUriParameterValue(): string
    {
        return $this->country;
    }

    public function getUriParameterName(): string
    {
        return 'country';
    }
}
