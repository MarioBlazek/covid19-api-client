<?php

namespace Marek\Covid19\API\Value\Parameter;

interface UriParameterInterface
{
    /**
     * Returns value for URI parameter.
     *
     * @return string
     */
    public function getUriParameterValue(): string;

    /**
     * Returns URI parameter identifier.
     *
     * @return string
     */
    public function getUriParameterName(): string;
}
