<?php

namespace Marek\Covid19\Tests\Unit\Core\Cache;

use Marek\Covid19\API\Constraints\TimeToLive;
use Marek\Covid19\Core\Cache\SymfonyCache;
use Symfony\Component\Cache\Adapter\AdapterInterface;
use Marek\Covid19\API\Cache\HandlerInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Contracts\Cache\ItemInterface;

class SymfonyCacheTest extends TestCase
{
    protected $adapter;

    protected $item;

    public function setUp(): void
    {
        $this->adapter = $this->createMock(AdapterInterface::class);
        $this->item = $this->createMock(ItemInterface::class);
    }

    public function testCacheIsHitFalse(): void
    {
        $cache = new SymfonyCache($this->adapter, TimeToLive::TTL_NONE);

        $key = 'test_key';

        $this->adapter->expects($this->once())
            ->method('getItem')
            ->with($this->getKey($key))
            ->willReturn($this->item);

        $this->item->expects($this->once())
            ->method('isHit')
            ->willReturn(false);

        $this->assertFalse($cache->has($key));
    }

    public function testCacheHitTrue(): void
    {
        $cache = new SymfonyCache($this->adapter, TimeToLive::TTL_NONE);

        $key = 'test_key';
        $value = ['some_value'];

        $this->adapter->expects($this->once())
            ->method('getItem')
            ->with($this->getKey($key))
            ->willReturn($this->item);

        $this->item->expects($this->once())
            ->method('get')
            ->willReturn($value);

        $this->assertEquals($value, $cache->get($key));
    }

    public function testCacheSubmitValueToCache(): void
    {
        $cache = new SymfonyCache($this->adapter, TimeToLive::TTL_ONE_HOUR);

        $key = 'test_key';
        $value = ['some_value'];

        $this->adapter->expects($this->once())
            ->method('getItem')
            ->with($this->getKey($key))
            ->willReturn($this->item);

        $this->item->expects($this->once())
            ->method('expiresAfter')
            ->with(TimeToLive::TTL_ONE_HOUR);

        $this->item->expects($this->once())
            ->method('set')
            ->with($value);

        $this->adapter->expects($this->once())
            ->method('save')
            ->with($this->item);

        $cache->set($key, $value);
    }

    private function getKey(string $key): string
    {
        return md5(HandlerInterface::CACHE_KEY_PREFIX . $key);
    }
}
