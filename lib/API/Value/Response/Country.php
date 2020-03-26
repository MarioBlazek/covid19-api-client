<?php

declare(strict_types=1);

namespace Marek\Covid19\API\Value\Response;

class Country
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
     * @var array
     */
    public $provinces;
}
