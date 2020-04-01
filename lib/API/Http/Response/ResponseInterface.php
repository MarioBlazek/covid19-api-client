<?php

declare(strict_types=1);

namespace Marek\Covid19\API\Http\Response;

interface ResponseInterface
{
    public const HTTP_OK = 200;

    /**
     * Returns HTTP status code.
     */
    public function getStatusCode(): int;

    /**
     * Returns data from remote service.
     */
    public function getData(): array;

    /**
     * Returns true is HTTP status code is 200.
     */
    public function isOk(): bool;
}
