<?php

declare(strict_types=1);

namespace Marek\Covid19\API\Value\Parameter;

use Assert\Assertion;
use Marek\Covid19\API\Constraints\Cases;

class Status implements UriParameterInterface
{
    /**
     * @var string
     */
    protected $status;

    public function __construct(string $status)
    {
        Assertion::inArray($status, Cases::getValidEntries());
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
