<?php

namespace Marek\Covid19\API\Value\Response;

class Countries extends Response
{
    /**
     * @var \Marek\Covid19\API\Value\Response\Country[]
     */
    protected $countries;

    /**
     * @return \Marek\Covid19\API\Value\Response\Country[]
     */
    public function getCountries(): array
    {
        return $this->countries;
    }

    /**
     * @param \Marek\Covid19\API\Value\Response\Country[] $data
     */
    public function setData(array $data)
    {
        $this->countries = $data;
    }
}
