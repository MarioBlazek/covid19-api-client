<?php

declare(strict_types=1);

namespace Marek\Covid19\Core\Factory;

use Marek\Covid19\API\Value\Parameter\InputParameterBag;

final class UrlFactory
{
    public function build(InputParameterBag $bag): string
    {
        $url = $bag->getUrl();

        return $this->transformUriParameters($url, $bag);
    }

    public function buildBag(string $url): InputParameterBag
    {
        return new InputParameterBag($url);
    }

    /**
     * Transforms Uri parameters.
     */
    private function transformUriParameters(string $url, InputParameterBag $bag): string
    {
        foreach ($bag->getUriParameters() as $item) {
            $name = '{' . $item->getUriParameterName() . '}';
            $url = str_replace($name, $item->getUriParameterValue(), $url);
        }

        return $url;
    }
}
