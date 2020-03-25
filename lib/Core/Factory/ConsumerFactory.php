<?php

namespace Marek\Covid19\Core\Factory;

use Marek\Covid19\API\Cache\HandlerInterface;
use Marek\Covid19\Core\Http\Client\SymfonyHttpClient;
use Marek\Covid19\Core\Service\Consumer;
use Marek\Covid19\Denormalizer\Test;
use Symfony\Component\HttpClient\HttpClient;
use Marek\Covid19\API\Http\Client\HttpClientInterface;

class ConsumerFactory
{
    /**
     * @var \Marek\Covid19\API\Http\Client\HttpClientInterface
     */
    protected $httpClient;

    /**
     * @var \Marek\Covid19\API\Cache\HandlerInterface
     */
    protected $cache;

    /**
     * @var \Marek\Covid19\Core\Factory\UrlFactory
     */
    protected $factory;

    /**
     * @var \Marek\Covid19\Core\Factory\DenormalizerFactory
     */
    protected $denormalizer;

    public function __construct(HandlerInterface $cache)
    {
        $this->cache = $cache;
        $this->httpClient = new SymfonyHttpClient(HttpClient::create());
        $this->factory = new UrlFactory();
        $this->denormalizer = new DenormalizerFactory();
    }

    public function createAPIConsumer(): Consumer
    {
        return new Consumer(
            $this->httpClient,
            $this->factory,
            $this->cache,
            $this->denormalizer->create()
        );
    }
}
