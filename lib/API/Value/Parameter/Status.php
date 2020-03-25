<?php

namespace Marek\Covid19\API\Value\Parameter;

use Marek\Covid19\API\Constraints\Cases;

class Status implements UriParameterInterface
{
    protected $status;

    public function __construct(string $status = Cases::CONFIRMED)
    {
        $this->status = $status;
    }

    public function getUriParameterValue(): string
    {
        return $this->status;
    }

    public function getUriParameterName(): string
    {
        return 'case';
    }
}
