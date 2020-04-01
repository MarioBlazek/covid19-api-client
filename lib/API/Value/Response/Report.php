<?php

declare(strict_types=1);

namespace Marek\Covid19\API\Value\Response;

class Report extends Response
{
    /**
     * @var \Marek\Covid19\API\Value\Response\CountryReport[]
     */
    protected $reports;

    /**
     * @return \Marek\Covid19\API\Value\Response\CountryReport[]
     */
    public function getReports(): array
    {
        return $this->reports;
    }

    /**
     * @param \Marek\Covid19\API\Value\Response\CountryReport[] $data
     */
    public function setData(array $data): void
    {
        $this->reports = $data;
    }
}
