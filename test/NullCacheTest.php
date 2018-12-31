<?php

namespace Amp\Cache\Test;

use Amp\Cache\NullCache;
use Concurrent\AsyncTestCase;

class NullCacheTest extends AsyncTestCase
{
    public function test(): void
    {
        $cache = new NullCache;
        $cache->set("foo", "bar");
        $this->assertNull($cache->get("foo"));
        $this->assertFalse($cache->delete("foo"));
    }
}
