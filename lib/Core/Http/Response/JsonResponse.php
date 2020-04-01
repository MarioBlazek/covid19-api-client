<?php

declare(strict_types=1);

namespace Marek\Covid19\Core\Http\Response;

use Assert\Assertion;
use Marek\Covid19\API\Http\Response\ResponseInterface;
use function json_decode;

final class JsonResponse implements ResponseInterface
{
    /**
     * @var array
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
        Assertion::isJsonString($data);

        $this->data = json_decode($data, true, 512, JSON_THROW_ON_ERROR);
        $this->httpCode = $httpCode;
    }

    /**
     * Returns data represented as string.
     */
    public function __toString(): string
    {
        return (string)json_encode($this->data, JSON_THROW_ON_ERROR);
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
        return $this->httpCode === self::HTTP_OK;
    }
}
