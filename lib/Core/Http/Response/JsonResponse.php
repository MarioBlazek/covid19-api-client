<?php

declare(strict_types=1);

namespace Marek\Covid19\Core\Http\Response;

use Marek\Covid19\API\Http\Response\ResponseInterface;

final class JsonResponse implements ResponseInterface
{
    /**
     * @var array|string
     */
    private $data;

    /**
     * @var int
     */
    private $httpCode;

    /**
     * Response constructor.
     */
    public function __construct(string $data, int $httpCode)
    {
        if ($this->isValidJson($data)) {
            $data = json_decode($data, true, 512, JSON_THROW_ON_ERROR);
        }
        $this->data = $data;

        $this->httpCode = $httpCode;
    }

    /**
     * Returns data represented as string.
     */
    public function __toString(): string
    {
        if (is_array($this->data)) {
            return json_encode($this->data, JSON_THROW_ON_ERROR);
        }

        return $this->data;
    }

    /**
     * {@inheritdoc}
     */
    public function getStatusCode(): int
    {
        return $this->httpCode;
    }

    /**
     * {@inheritdoc}
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * {@inheritdoc}
     */
    public function isOk(): bool
    {
        if ($this->httpCode === 200) {
            return true;
        }

        return false;
    }

    /**
     * Checks if given string is valid json.
     *
     * @param string $string
     */
    private function isValidJson($string): bool
    {
        if (!is_string($string)) {
            return false;
        }

        json_decode($string, false, 512, JSON_THROW_ON_ERROR);

        return json_last_error() === JSON_ERROR_NONE;
    }
}
