<?php

namespace Micronative\ObjectFactory\Database\Doctrine;

use spec\Prophecy\Doubler\aClass;

interface DoctrineConfigInterface
{
    /**
     * @return array
     */
    public function getConnection(): array;
    
    /**
     * @return string
     */
    public function getConnectionName(): string;
    
    /**
     * @param string $connectionName
     * @return \Micronative\ObjectFactory\Database\Doctrine\DoctrineConfigInterface
     */
    public function setConnectionName(string $connectionName = null): DoctrineConfigInterface;
    
    /**
     * @return string
     */
    public function getDriver(): string;
    
    /**
     * @param string $driver
     * @return \Micronative\ObjectFactory\Database\Doctrine\DoctrineConfigInterface
     */
    public function setDriver(string $driver = null): DoctrineConfigInterface;
    
    /**
     * @return string
     */
    public function getHost(): string;
    
    /**
     * @param string $host
     * @return \Micronative\ObjectFactory\Database\Doctrine\DoctrineConfigInterface
     */
    public function setHost(string $host = null): DoctrineConfigInterface;
    
    /**
     * @return string
     */
    public function getPort(): string;
    
    /**
     * @param string $port
     * @return \Micronative\ObjectFactory\Database\Doctrine\DoctrineConfigInterface
     */
    public function setPort(string $port = null);
    
    /**
     * @return string
     */
    public function getDbname(): string;
    
    /**
     * @param string $dbname
     * @return \Micronative\ObjectFactory\Database\Doctrine\DoctrineConfig
     */
    public function setDbname(string $dbname = null): DoctrineConfigInterface;
    
    /**
     * @return string
     */
    public function getUser(): string;
    
    /**
     * @param string $user
     * @return \Micronative\ObjectFactory\Database\Doctrine\DoctrineConfigInterface
     */
    public function setUser(string $user = null): DoctrineConfigInterface;
    
    /**
     * @return string
     */
    public function getPassword(): string;
    
    /**
     * @param string $password
     * @return \Micronative\ObjectFactory\Database\Doctrine\DoctrineConfigInterface
     */
    public function setPassword(string $password = null): DoctrineConfigInterface;
    
    /**
     * @return string
     */
    public function getCharset(): string;
    
    /**
     * @param string $charset
     * @return \Micronative\ObjectFactory\Database\Doctrine\DoctrineConfigInterface
     */
    public function setCharset(string $charset = null): DoctrineConfigInterface;
    
    /**
     * @return string
     */
    public function getCollation(): string;
    
    /**
     * @param string $collation
     * @return \Micronative\ObjectFactory\Database\Doctrine\DoctrineConfigInterface
     */
    public function setCollation(string $collation): DoctrineConfigInterface;
    
    /**
     * @return string
     */
    public function getPrefix(): string;
    
    /**
     * @param string $prefix
     * @return \Micronative\ObjectFactory\Database\Doctrine\DoctrineConfigInterface
     */
    public function setPrefix(string $prefix): DoctrineConfigInterface;
    
    /**
     * @return bool
     */
    public function isMemory(): bool;
    
    /**
     * @param bool $memory
     * @return \Micronative\ObjectFactory\Database\Doctrine\DoctrineConfigInterface
     */
    public function setMemory(bool $memory): DoctrineConfigInterface;
    
    /**
     * @return bool
     */
    public function isDevMode(): bool;
    
    /**
     * @param bool $devMode
     * @return \Micronative\ObjectFactory\Database\Doctrine\DoctrineConfigInterface
     */
    public function setDevMode(bool $devMode): DoctrineConfigInterface;
    
    /**
     * @return bool
     */
    public function isCache(): bool;
    
    /**
     * @param bool $cache
     * @return \Micronative\ObjectFactory\Database\Doctrine\DoctrineConfigInterface
     */
    public function setCache(bool $cache): DoctrineConfigInterface;
    
    /**
     * @return array
     */
    public function getCacheDir(): array;
    
    /**
     * @param string $cacheDir
     * @return \Micronative\ObjectFactory\Database\Doctrine\DoctrineConfigInterface
     */
    public function setCacheDir(string $cacheDir = null): DoctrineConfigInterface;
    
    /**
     * @return array
     */
    public function getMetadataDirs(): array;
    
    /**
     * @param array $metadataDirs
     * @return \Micronative\ObjectFactory\Database\Doctrine\DoctrineConfigInterface
     */
    public function setMetadataDirs(array $metadataDirs = null): DoctrineConfigInterface;
    
    /**
     * @return array
     */
    public function getIgnoredNamespaces(): array;
    
    /**
     * @param string $ignoredNamespacess
     * @return \Micronative\ObjectFactory\Database\Doctrine\DoctrineConfigInterface
     */
    public function setIgnoredNamespaces(string $ignoredNamespacess = null): DoctrineConfigInterface;
    
}
