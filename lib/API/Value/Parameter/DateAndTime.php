<?php

declare(strict_types=1);

namespace Marek\Covid19\API\Value\Parameter;

use DateTimeInterface;

class DateAndTime implements UriParameterInterface
{
    /**
     * @var \DateTimeInterface
     */
    protected $dateTime;

    public function __construct(DateTimeInterface $dateTime)
    {
        $this->dateTime = $dateTime;
    }

    public function getUriParameterValue(): string
    {
        return $this->dateTime->format('Y-m-d\TH:i:s\Z');
    }

    public function getUriParameterName(): string
    {
        return 'date_and_time';
    }
}
