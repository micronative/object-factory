<?php

declare(strict_types=1);

namespace Micronative\ObjectFactory\Aws\Sqs;

interface SqsConfigInterface
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
     * @return SqsConfigInterface
     */
    public function setConnectionName(string $connectionName): SqsConfigInterface;
    
    /**
     * @return string|null
     */
    public function getKey(): ?string;
    
    /**
     * @param string|null $key
     * @return \Micronative\ObjectFactory\Aws\Sqs\SqsConfigInterface
     */
    public function setKey(string $key = null): SqsConfigInterface;
    
    /**
     * @return string|null
     */
    public function getSecret(): ?string;
    
    /**
     * @param string|null $secret
     * @return \Micronative\ObjectFactory\Aws\Sqs\SqsConfigInterface
     */
    public function setSecret(string $secret = null): SqsConfigInterface;
    
    /**
     * @return string|null
     */
    public function getRegion(): ?string;
    
    /**
     * @param string|null $region
     * @return \Micronative\ObjectFactory\Aws\Sqs\SqsConfigInterface
     */
    public function setRegion(string $region = null): SqsConfigInterface;
    
    /**
     * @return string|null
     */
    public function getQueue(): ?string;
    
    /**
     * @param string|null $queue
     * @return \Micronative\ObjectFactory\Aws\Sqs\SqsConfigInterface
     */
    public function setQueue(string $queue = null): SqsConfigInterface;
    
    /**
     * @return bool|null
     */
    public function isFifo(): ?bool;
    
    /**
     * @param bool|null $fifo
     * @return \Micronative\ObjectFactory\Aws\Sqs\SqsConfigInterface
     */
    public function setFifo(bool $fifo = null): SqsConfigInterface;
    
}
