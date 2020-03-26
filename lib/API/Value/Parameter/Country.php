<?php

namespace Marek\Covid19\API\Value\Parameter;

use Assert\Assertion;
use Marek\Covid19\API\Constraints\Countries;

class Country implements UriParameterInterface
{
    /**
     * @var string
     */
    protected $country;

    public function __construct(string $country)
    {
        Assertion::inArray($country, Countries::getValidEntries());
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
