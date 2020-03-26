<?php

namespace Marek\Covid19\Core\Cache;

use Marek\Covid19\API\Cache\HandlerInterface;
use Symfony\Component\Cache\Adapter\AdapterInterface;

class SymfonyCache implements HandlerInterface
{
    /**
     * @var \Symfony\Component\Cache\Adapter\AdapterInterface
     */
    protected $cache;

    /**
     * @var int
     */
    protected $timeToLive;

    /**
     * SymfonyCache constructor.
     *
     * @param \Symfony\Component\Cache\Adapter\AdapterInterface $cache
     * @param int $timeToLive
     */
    public function __construct(AdapterInterface $cache, int $timeToLive = 3600)
    {
        $this->cache = $cache;
        $this->timeToLive = $timeToLive;
    }

    public function has(string $cacheKey): bool
    {
        $key = $this->computeKey($cacheKey);

        $item = $this->cache->getItem($key);

        dump($item->isHit());
        return $item->isHit();
    }

    public function get(string $cacheKey): array
    {
        $key = $this->computeKey($cacheKey);

        $item = $this->cache->getItem($key);

        return $item->get();
    }

    public function set(string $cacheKey, array $data): void
    {
        $key = $this->computeKey($cacheKey);

        $item = $this->cache->getItem($key);
        $item->expiresAfter($this->timeToLive);
        $item->set($data);

        $this->cache->save($item);
    }

    protected function computeKey(string $cacheKey): string
    {
        return md5(self::CACHE_KEY_PREFIX . $cacheKey);
    }
}
