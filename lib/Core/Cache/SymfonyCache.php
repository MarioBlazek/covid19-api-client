<?php

declare(strict_types=1);

namespace Marek\Covid19\Core\Cache;

use Marek\Covid19\API\Cache\HandlerInterface;
use Symfony\Component\Cache\Adapter\AdapterInterface;
use Marek\Covid19\API\Constraints\TimeToLive;

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
     */
    public function __construct(AdapterInterface $cache, int $timeToLive = TimeToLive::TTL_ONE_HOUR)
    {
        $this->cache = $cache;
        $this->timeToLive = $timeToLive;
    }

    public function has(string $cacheKey): bool
    {
        $key = $this->computeKey($cacheKey);

        $item = $this->cache->getItem($key);

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
