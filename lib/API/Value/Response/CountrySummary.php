<?php

declare(strict_types=1);

namespace Marek\Covid19\API\Value\Response;

class CountrySummary
{
    /**
     * @var string
     */
    public $country;

    /**
     * @var string
     */
    public $slug;

    /**
     * @var int
     */
    public $newConfirmed;

    /**
     * @var int
     */
    public $totalConfirmed;

    /**
     * @var int
     */
    public $newDeaths;

    /**
     * @var int
     */
    public $totalDeaths;

    /**
     * @var int
     */
    public $newRecovered;

    /**
     * @var int
     */
    public $totalRecovered;
}
