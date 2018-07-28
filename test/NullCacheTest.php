<?php

namespace Amp\Cache\Test;

use Amp\Cache\NullCache;
use Amp\PHPUnit\TestCase;

class NullCacheTest extends TestCase
{
    public function test(): void
    {
        $cache = new NullCache;
        $cache->set("foo", "bar");
        $this->assertNull($cache->get("foo"));
        $this->assertFalse($cache->delete("foo"));
    }
}
