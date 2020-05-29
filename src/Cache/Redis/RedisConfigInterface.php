<?php

namespace Micronative\ObjectFactory\Cache\Redis;

interface RedisConfigInterface
{
    
    /**
     * @return string[]
     */
    public function toArray(): array;
    
    /**
     * @return string|null
     */
    public function getScheme(): ?string;
    
    /**
     * @param string|null $scheme
     * @return \Micronative\ObjectFactory\Cache\Redis\RedisConfigInterface
     */
    public function setScheme(?string $scheme = null): RedisConfigInterface;
    
    /**
     * @return string|null
     */
    public function getHost(): ?string;
    
    /**
     * @param string|null $host
     * @return \Micronative\ObjectFactory\Cache\Redis\RedisConfigInterface
     */
    public function setHost(?string $host = null): RedisConfigInterface;
    
    /**
     * @return int|null
     */
    public function getPort(): ?int;
    
    /**
     * @param int|null $port
     * @return \Micronative\ObjectFactory\Cache\Redis\RedisConfigInterface
     */
    public function setPort(?int $port = null): RedisConfigInterface;
    
}
