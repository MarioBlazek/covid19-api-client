<?php

declare(strict_types=1);

namespace Marek\Covid19\API\Cache;

interface HandlerInterface
{
    /**
     * @const string
     */
    public const CACHE_KEY_PREFIX = 'marek-covid19-api';

    /**
     * Returns if there is a valid cache entry for provided cache key.
     */
    public function has(string $cacheKey): bool;

    /**
     * Returns the data from cache entry for provided cache key.
     *
     * @throws \Marek\Covid19\API\Exception\ItemNotFoundException
     */
    public function get(string $cacheKey): array;

    /**
     * Sets the data to cache entry for provided cache key.
     */
    public function set(string $cacheKey, array $data): void;
}
