<?php

namespace Amp\Cache\Test;

use Amp\Cache\Cache;
use Concurrent\AsyncTestCase;

abstract class CacheTest extends AsyncTestCase
{
    abstract protected function createCache(): Cache;

    public function testGet(): void
    {
        $cache = $this->createCache();

        $result = $cache->get("mykey");
        $this->assertNull($result);

        $cache->set("mykey", "myvalue", 10);

        $result = $cache->get("mykey");
        $this->assertSame("myvalue", $result);
    }

    public function testEntryIsntReturnedAfterTTLHasPassed(): void
    {
        $cache = $this->createCache();

        $cache->set("foo", "bar", 0);
        \sleep(1);

        $this->assertNull($cache->get("foo"));
    }

    public function testEntryIsReturnedWhenOverriddenWithNoTimeout(): void
    {
        $cache = $this->createCache();

        $cache->set("foo", "bar", 0);
        $cache->set("foo", "bar");
        \sleep(1);

        $this->assertNotNull($cache->get("foo"));
    }

    public function testEntryIsntReturnedAfterDelete(): void
    {
        $cache = $this->createCache();

        $cache->set("foo", "bar");
        $cache->delete("foo");

        $this->assertNull($cache->get("foo"));
    }

    /**
     * @dataProvider provideBadTTLs
     */
    public function testSetFailsOnInvalidTTL($badTTL): void
    {
        $this->expectException(\Error::class);

        $cache = $this->createCache();
        $cache->set("mykey", "myvalue", $badTTL);
    }

    public function provideBadTTLs(): array
    {
        return [
            [-1],
            [new \StdClass],
            [[]],
        ];
    }
}
