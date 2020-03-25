<?php

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
     *
     * @param string $data
     * @param int $httpCode
     */
    public function __construct(string $data, int $httpCode)
    {
        if ($this->isValidJson($data)) {
            $data = json_decode($data, true, 512, JSON_THROW_ON_ERROR);
        }
        $this->data = $data;

        if (is_array($data) && array_key_exists('cod', $data)) {
            $this->httpCode = (int)$data['cod'];
        } else {
            $this->httpCode = $httpCode;
        }
    }

    /**
     * Returns data represented as string.
     *
     * @return string
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
     * {@inheritdoc}
     */
    public function isAuthorized(): bool
    {
        if ($this->httpCode !== 401) {
            return true;
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function getMessage(): string
    {
        if (is_array($this->data) && array_key_exists('message', $this->data)) {
            return (string)$this->data['message'];
        }

        return '';
    }

    /**
     * Checks if given string is valid json.
     *
     * @param string $string
     *
     * @return bool
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
