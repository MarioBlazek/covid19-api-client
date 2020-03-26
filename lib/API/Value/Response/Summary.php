<?php

declare(strict_types=1);

namespace Marek\Covid19\API\Value\Response;

class Summary extends Response
{
    /**
     * @var \Marek\Covid19\API\Value\Response\CountrySummary[]
     */
    protected $summaries;

    /**
     * @return \Marek\Covid19\API\Value\Response\CountrySummary[]
     */
    public function getSummaries(): array
    {
        return $this->summaries;
    }

    /**
     * @param \Marek\Covid19\API\Value\Response\CountrySummary[] $data
     */
    public function setData(array $data)
    {
        $this->summaries = $data;
    }
}
