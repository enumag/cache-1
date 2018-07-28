<?php

namespace Amp\Cache;

interface Cache
{
    /**
     * Gets a value associated with the given key.
     *
     * If the specified key doesn't exist implementations MUST return `null`.
     *
     * @param $key string Cache key.
     *
     * @return string|null Cached value or `null` if it doesn't exist.
     *
     * @throws CacheException If the cache access fails.
     */
    public function get(string $key): ?string;

    /**
     * Sets a value associated with the given key, overrides an existing value (if it exists).
     *
     * @param $key string Cache key.
     * @param $value string Value to cache.
     * @param $ttl int Timeout in seconds. The default `null` value indicates *no* timeout. Values less than 0 MUST
     * throw an \Error.
     *
     * @throws CacheException If the cache write fails.
     */
    public function set(string $key, string $value, int $ttl = null): void;

    /**
     * Deletes a value associated with the given key if it exists.
     *
     * Implementations SHOULD return boolean `true` or `false` to indicate whether the specified key existed at the time
     * the delete operation was requested. If such information is not available, the implementation MUST return `null`.
     *
     * Implementations MUST NOT throw for non-existent keys.
     *
     * @param $key string Cache key.
     *
     * @return bool|null
     */
    public function delete(string $key): ?bool;
}
