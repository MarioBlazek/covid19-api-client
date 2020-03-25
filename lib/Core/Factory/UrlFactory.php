<?php

namespace Marek\Covid19\Core\Factory;

use Marek\Covid19\API\Value\Parameter\InputParameterBag;

final class UrlFactory
{
    /**
     * @param \Marek\Covid19\API\Value\Parameter\InputParameterBag $bag
     *
     * @return string
     */
    public function build(InputParameterBag $bag): string
    {
        $url = $bag->getUrl();

        return $this->transformUriParameters($url, $bag);
    }

    /**
     * @param string $url
     *
     * @return \Marek\Covid19\API\Value\Parameter\InputParameterBag
     */
    public function buildBag(string $url): InputParameterBag
    {
        return new InputParameterBag($url);
    }

    /**
     * Transforms Uri parameters.
     *
     * @param string $url
     * @param \Marek\Covid19\API\Value\Parameter\InputParameterBag $bag
     *
     * @return string
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
