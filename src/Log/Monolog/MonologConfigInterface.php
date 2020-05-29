<?php

declare(strict_types=1);

namespace Micronative\ObjectFactory\Log\Monolog;

interface MonologConfigInterface
{
    /**
     * @return array
     */
    public function getSentryConfig(): array;
    
    /**
     * @return string
     */
    public function getName(): string;
    
    /**
     * @param string $name
     * @return \Micronative\ObjectFactory\Log\Monolog\MonologConfigInterface
     */
    public function setName(string $name = null): MonologConfigInterface;
    
    /**
     * @return string
     */
    public function getPath(): string;
    
    /**
     * @param string $path
     * @return \Micronative\ObjectFactory\Log\Monolog\MonologConfigInterface
     */
    public function setPath(string $path = null): MonologConfigInterface;
    
    /**
     * @return int
     */
    public function getLevel(): int;
    
    /**
     * @param int|string $level
     * @return \Micronative\ObjectFactory\Log\Monolog\MonologConfigInterface
     */
    public function setLevel($level = null): MonologConfigInterface;
    
    /**
     * @return bool
     */
    public function isSentry(): bool;
    
    /**
     * @param bool $sentry
     * @return \Micronative\ObjectFactory\Log\Monolog\MonologConfigInterface
     */
    public function setSentry(bool $sentry = null): MonologConfigInterface;
    
    /**
     * @return string
     */
    public function getSentryDsn(): string;
    
    /**
     * @param string $sentryDsn
     * @return \Micronative\ObjectFactory\Log\Monolog\MonologConfigInterface
     */
    public function setSentryDsn(string $sentryDsn = null): MonologConfigInterface;
    
    /**
     * @return string
     */
    public function getSentryPublicKey(): string;
    
    /**
     * @param string $sentryPublicKey
     * @return \Micronative\ObjectFactory\Log\Monolog\MonologConfigInterface
     */
    public function setSentryPublicKey(string $sentryPublicKey = null): MonologConfigInterface;
    
    /**
     * @return string
     */
    public function getSentryHost(): string;
    
    /**
     * @param string $sentryHost
     * @return \Micronative\ObjectFactory\Log\Monolog\MonologConfigInterface
     */
    public function setSentryHost(string $sentryHost = null): MonologConfigInterface;
    
    /**
     * @return string
     */
    public function getSentryProjectId(): string;
    
    /**
     * @param string $sentryProjectId
     * @return \Micronative\ObjectFactory\Log\Monolog\MonologConfigInterface
     */
    public function setSentryProjectId(string $sentryProjectId = null): MonologConfigInterface;
    
    /**
     * @return string
     */
    public function getConfigName(): string;
    
    /**
     * @param string $configName
     * @return \Micronative\ObjectFactory\Log\Monolog\MonologConfigInterface
     */
    public function setConfigName(string $configName = null): MonologConfigInterface;
    
    /**
     * @return string
     */
    public function getSentryEnvironment(): string;
    
    /**
     * @param string $sentryEnvironment
     * @return \Micronative\ObjectFactory\Log\Monolog\MonologConfigInterface
     */
    public function setSentryEnvironment(string $sentryEnvironment = null): MonologConfigInterface;
    
}
