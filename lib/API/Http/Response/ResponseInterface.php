<?php

namespace Marek\Covid19\API\Http\Response;

interface ResponseInterface
{
    /**
     * Returns HTTP status code.
     *
     * @return int
     */
    public function getStatusCode(): int;

    /**
     * Returns data from remote service.
     *
     * @return array
     */
    public function getData(): array;

    /**
     * Returns true is HTTP status code is 200.
     *
     * @return bool
     */
    public function isOk(): bool;
}
