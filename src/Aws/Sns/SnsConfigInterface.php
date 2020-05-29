<?php

declare(strict_types=1);

namespace Micronative\ObjectFactory\Aws\Sns;

interface SnsConfigInterface
{
    /**
     * @return string[]
     */
    public function toArray(): array;
    
    /**
     * @return string
     */
    public function getConnectionName(): string;
    
    /**
     * @param string $connectionName
     * @return SnsConfigInterface
     */
    public function setConnectionName(string $connectionName): SnsConfigInterface;
    
    /**
     * @return string
     */
    public function getKey(): string;
    
    /**
     * @param string $key
     * @return SnsConfigInterface
     */
    public function setKey(string $key): SnsConfigInterface;
    
    /**
     * @return string
     */
    public function getSecret(): string;
    
    /**
     * @param string $secret
     * @return SnsConfigInterface
     */
    public function setSecret(string $secret): SnsConfigInterface;
    
    /**
     * @return string
     */
    public function getRegion(): string;
    
    /**
     * @param string $region
     * @return SnsConfigInterface
     */
    public function setRegion(string $region): SnsConfigInterface;
}
