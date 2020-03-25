<?php

namespace Marek\Covid19\API\Value\Parameter;

final class InputParameterBag
{
    /**
     * @var array
     */
    private $uriParameters = [];

    /**
     * @var string
     */
    private $url;

    /**
     * InputParameterBag constructor.
     *
     * @param string $url
     */
    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function setUriParameter(UriParameterInterface $parameter): void
    {
        $this->uriParameters[] = $parameter;
    }

    /**
     * @return UriParameterInterface[]
     */
    public function getUriParameters(): array
    {
        return $this->uriParameters;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }
}
