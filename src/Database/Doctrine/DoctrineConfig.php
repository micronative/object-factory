<?php

namespace Micronative\ObjectFactory\Database\Doctrine;

class DoctrineConfig implements DoctrineConfigInterface
{
    
    /** @var string */
    protected $connectionName;
    
    /** @var string */
    protected $driver;
    
    /** @var string */
    protected $host;
    
    /** @var string */
    protected $port;
    
    /** @var string */
    protected $dbname;
    
    /** @var string */
    protected $user;
    
    /** @var string */
    protected $password;
    
    /** @var string */
    protected $charset;
    
    /** @var string */
    protected $collation;
    
    /** @var string */
    protected $prefix;
    
    /** @var bool in-memory database (for pdo_sqlite) */
    protected $memory;
    
    /** @var bool */
    protected $devMode;
    
    /** @var bool */
    protected $cache;
    
    /** @var string */
    protected $cacheDir;
    
    /** @var array */
    protected $metadataDirs;
    
    /** @var array */
    protected $ignoredNamespaces;
    
    /**
     * DoctrineConfig constructor.
     *
     * @param string|null $connectionName
     * @param array|null $config
     */
    public function __construct(?string $connectionName = null, ?array $config = null)
    {
        $this->connectionName    = $connectionName;
        $this->driver            = $config['driver'] ?? null;
        $this->host              = $config['host'] ?? null;
        $this->port              = $config['port'] ?? null;
        $this->dbname            = $config['dbname'] ?? null;
        $this->user              = $config['user'] ?? null;
        $this->password          = $config['password'] ?? null;
        $this->charset           = $config['charset'] ?? null;
        $this->collation         = $config['collation'] ?? null;
        $this->prefix            = $config['prefix'] ?? null;
        $this->cacheDir          = $config['cache_dir'] ?? null;
        $this->memory            = (isset($config['memory']) && $config['memory'] == "true") ? true : false;
        $this->devMode           = (isset($config['dev_mode']) && $config['dev_mode'] == "true") ? true : false;
        $this->cache             = (isset($config['cache']) && $config['cache'] == "true") ? true : false;
        $this->metadataDirs      = isset($config['metadata_dirs']) ? explode(',', $config['metadata_dirs']) : null;
        $this->ignoredNamespaces = isset($config['ignored_namespaces']) ? explode(',', $config['ignored_namespaces']) : null;
    }
    
    /**
     * @return array
     */
    public function getConnection(): array
    {
        return [
            'driver'    => $this->driver,
            'host'      => $this->host,
            'port'      => $this->port,
            'dbname'    => $this->dbname,
            'user'      => $this->user,
            'password'  => $this->password,
            'charset'   => $this->charset,
            'collation' => $this->collation,
            'prefix'    => $this->prefix,
            'memory'    => $this->memory,
        ];
    }
    
    /**
     * @return string
     */
    public function getConnectionName(): string
    {
        return $this->connectionName;
    }
    
    /**
     * @param string $connectionName
     * @return \Micronative\ObjectFactory\Database\Doctrine\DoctrineConfigInterface
     */
    public function setConnectionName(string $connectionName = null): DoctrineConfigInterface
    {
        $this->connectionName = $connectionName;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getDriver(): string
    {
        return $this->driver;
    }
    
    /**
     * @param string $driver
     * @return \Micronative\ObjectFactory\Database\Doctrine\DoctrineConfigInterface
     */
    public function setDriver(string $driver = null): DoctrineConfigInterface
    {
        $this->driver = $driver;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }
    
    /**
     * @param string $host
     * @return \Micronative\ObjectFactory\Database\Doctrine\DoctrineConfigInterface
     */
    public function setHost(string $host = null): DoctrineConfigInterface
    {
        $this->host = $host;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getPort(): string
    {
        return $this->port;
    }
    
    /**
     * @param string $port
     * @return \Micronative\ObjectFactory\Database\Doctrine\DoctrineConfigInterface
     */
    public function setPort(string $port = null): DoctrineConfigInterface
    {
        $this->port = $port;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getDbname(): string
    {
        return $this->dbname;
    }
    
    /**
     * @param string $dbname
     * @return \Micronative\ObjectFactory\Database\Doctrine\DoctrineConfigInterface
     */
    public function setDbname(string $dbname = null): DoctrineConfigInterface
    {
        $this->dbname = $dbname;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getUser(): string
    {
        return $this->user;
    }
    
    /**
     * @param string $user
     * @return \Micronative\ObjectFactory\Database\Doctrine\DoctrineConfigInterface
     */
    public function setUser(string $user = null): DoctrineConfigInterface
    {
        $this->user = $user;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }
    
    /**
     * @param string $password
     * @return \Micronative\ObjectFactory\Database\Doctrine\DoctrineConfigInterface
     */
    public function setPassword(string $password = null): DoctrineConfigInterface
    {
        $this->password = $password;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getCharset(): string
    {
        return $this->charset;
    }
    
    /**
     * @param string $charset
     * @return \Micronative\ObjectFactory\Database\Doctrine\DoctrineConfigInterface
     */
    public function setCharset(string $charset = null): DoctrineConfigInterface
    {
        $this->charset = $charset;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getCollation(): string
    {
        return $this->collation;
    }
    
    /**
     * @param string $collation
     * @return \Micronative\ObjectFactory\Database\Doctrine\DoctrineConfigInterface
     */
    public function setCollation(string $collation): DoctrineConfigInterface
    {
        $this->collation = $collation;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getPrefix(): string
    {
        return $this->prefix;
    }
    
    /**
     * @param string $prefix
     * @return \Micronative\ObjectFactory\Database\Doctrine\DoctrineConfigInterface
     */
    public function setPrefix(string $prefix): DoctrineConfigInterface
    {
        $this->prefix = $prefix;
        
        return $this;
    }
    
    /**
     * @return bool
     */
    public function isMemory(): bool
    {
        return $this->memory;
    }
    
    /**
     * @param bool $memory
     * @return \Micronative\ObjectFactory\Database\Doctrine\DoctrineConfigInterface
     */
    public function setMemory(bool $memory): DoctrineConfigInterface
    {
        $this->memory = $memory;
        
        return $this;
    }
    
    /**
     * @return bool
     */
    public function isDevMode(): bool
    {
        return $this->devMode;
    }
    
    /**
     * @param bool $devMode
     * @return \Micronative\ObjectFactory\Database\Doctrine\DoctrineConfigInterface
     */
    public function setDevMode(bool $devMode): DoctrineConfigInterface
    {
        $this->devMode = $devMode;
        
        return $this;
    }
    
    /**
     * @return bool
     */
    public function isCache(): bool
    {
        return $this->cache;
    }
    
    /**
     * @param bool $cache
     * @return \Micronative\ObjectFactory\Database\Doctrine\DoctrineConfigInterface
     */
    public function setCache(bool $cache): DoctrineConfigInterface
    {
        $this->cache = $cache;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getCacheDir(): string
    {
        return $this->cacheDir;
    }
    
    /**
     * @param string $cacheDir
     * @return \Micronative\ObjectFactory\Database\Doctrine\DoctrineConfigInterface
     */
    public function setCacheDir(string $cacheDir = null): DoctrineConfigInterface
    {
        $this->cacheDir = $cacheDir;
        
        return $this;
    }
    
    /**
     * @return array
     */
    public function getMetadataDirs(): array
    {
        return $this->metadataDirs;
    }
    
    /**
     * @param array $metadataDirs
     * @return \Micronative\ObjectFactory\Database\Doctrine\DoctrineConfigInterface
     */
    public function setMetadataDirs(array $metadataDirs = null): DoctrineConfigInterface
    {
        $this->metadataDirs = $metadataDirs;
        
        return $this;
    }
    
    /**
     * @return array
     */
    public function getIgnoredNamespaces(): array
    {
        return $this->ignoredNamespaces;
    }
    
    /**
     * @param string $ignoredNamespacess
     * @return \Micronative\ObjectFactory\Database\Doctrine\DoctrineConfigInterface
     */
    public function setIgnoredNamespaces(string $ignoredNamespacess = null): DoctrineConfigInterface
    {
        $this->ignoredNamespaces = $ignoredNamespacess;
        
        return $this;
    }
    
}
