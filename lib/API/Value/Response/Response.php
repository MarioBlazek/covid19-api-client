<?php

declare(strict_types=1);

namespace Marek\Covid19\API\Value\Response;

abstract class Response
{
    /**
     * @param array $data
     */
    abstract public function setData(array $data): void;
}
