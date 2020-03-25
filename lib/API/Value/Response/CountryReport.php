<?php

namespace Marek\Covid19\API\Value\Response;

class CountryReport
{
    /**
     * @var string
     */
    public $country;

    /**
     * @var string
     */
    public $province;

    /**
     * @var float
     */
    public $latitude;

    /**
     * @var float
     */
    public $longitude;

    /**
     * @var \DateTimeInterface
     */
    public $date;

    /**
     * @var int
     */
    public $cases;

    /**
     * @var string
     */
    public $status;
}
