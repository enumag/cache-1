<?php

namespace Amp\Cache;

/**
 * Cache implementation that just ignores all operations and always resolves to `null`.
 */
class NullCache implements Cache
{
    /** @inheritdoc */
    public function get(string $key): ?string
    {
        return null;
    }

    /** @inheritdoc */
    public function set(string $key, string $value, int $ttl = null): void
    {
        // do nothing
    }

    /** @inheritdoc */
    public function delete(string $key): ?bool
    {
        return false;
    }
}
