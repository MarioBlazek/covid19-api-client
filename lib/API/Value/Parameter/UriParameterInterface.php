<?php

declare(strict_types=1);

namespace Marek\Covid19\API\Value\Parameter;

interface UriParameterInterface
{
    /**
     * Returns value for URI parameter.
     */
    public function getUriParameterValue(): string;

    /**
     * Returns URI parameter identifier.
     */
    public function getUriParameterName(): string;
}
