<?php

declare(strict_types=1);

namespace Micronative\ObjectFactory\Log\Monolog;

class MonologConfig implements MonologConfigInterface
{
    
    /** @var string */
    protected $configName;
    
    /** @var string */
    protected $name;
    
    /** @var string */
    protected $path;
    
    /** @var string|int */
    protected $level;
    
    /** @var bool */
    protected $sentry;
    
    /** @var string */
    protected $sentryDsn;
    
    /** @var string */
    protected $sentryPublicKey;
    
    /** @var string */
    protected $sentryHost;
    
    /** @var string */
    protected $sentryProjectId;
    
    /** @var string */
    protected $sentryEnvironment;
    
    /**
     * MonologConfig constructor.
     *
     * @param string|null $configName
     * @param array|null $config
     */
    public function __construct(string $configName = null, ?array $config = null)
    {
        $this->configName        = $configName;
        $this->name              = isset($config['name']) ? $config['name'] : null;
        $this->path              = isset($config['path']) ? $config['path'] : null;
        $this->level             = isset($config['level']) ? $config['level'] : null;
        $this->sentry            = (isset($config['sentry']) && $config['sentry'] == "true") ? true : false;
        $this->sentryDsn         = isset($config['sentry_dsn']) ? $config['sentry_dsn'] : null;
        $this->sentryPublicKey   = isset($config['sentry_public_key']) ? $config['sentry_public_key'] : null;
        $this->sentryHost        = isset($config['sentry_host']) ? $config['sentry_host'] : null;
        $this->sentryProjectId   = isset($config['sentry_project_id']) ? $config['sentry_project_id'] : null;
        $this->sentryEnvironment = isset($config['sentry_environment']) ? $config['sentry_environment'] : null;
    }
    
    /**
     * @return array
     */
    public function getSentryConfig(): array
    {
        return [
            'dsn'         => $this->sentryDsn,
            'public_key'  => $this->sentryPublicKey,
            'host'        => $this->sentryHost,
            'project_id'  => $this->sentryProjectId,
            'environment' => $this->sentryEnvironment,
        ];
    }
    
    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
    
    /**
     * @param string $name
     * @return \Micronative\ObjectFactory\Log\Monolog\MonologConfigInterface
     */
    public function setName(string $name = null): MonologConfigInterface
    {
        $this->name = $name;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }
    
    /**
     * @param string $path
     * @return \Micronative\ObjectFactory\Log\Monolog\MonologConfigInterface
     */
    public function setPath(string $path = null): MonologConfigInterface
    {
        $this->path = $path;
        
        return $this;
    }
    
    /**
     * @return int
     */
    public function getLevel(): int
    {
        return $this->level;
    }
    
    /**
     * @param int|string $level
     * @return \Micronative\ObjectFactory\Log\Monolog\MonologConfigInterface
     */
    public function setLevel($level = null): MonologConfigInterface
    {
        $this->level = $level;
        
        return $this;
    }
    
    /**
     * @return bool
     */
    public function isSentry(): bool
    {
        return $this->sentry;
    }
    
    /**
     * @param bool $sentry
     * @return \Micronative\ObjectFactory\Log\Monolog\MonologConfigInterface
     */
    public function setSentry(bool $sentry = null): MonologConfigInterface
    {
        $this->sentry = $sentry;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getSentryDsn(): string
    {
        return $this->sentryDsn;
    }
    
    /**
     * @param string $sentryDsn
     * @return \Micronative\ObjectFactory\Log\Monolog\MonologConfigInterface
     */
    public function setSentryDsn(string $sentryDsn = null): MonologConfigInterface
    {
        $this->sentryDsn = $sentryDsn;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getSentryPublicKey(): string
    {
        return $this->sentryPublicKey;
    }
    
    /**
     * @param string $sentryPublicKey
     * @return \Micronative\ObjectFactory\Log\Monolog\MonologConfigInterface
     */
    public function setSentryPublicKey(string $sentryPublicKey = null): MonologConfigInterface
    {
        $this->sentryPublicKey = $sentryPublicKey;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getSentryHost(): string
    {
        return $this->sentryHost;
    }
    
    /**
     * @param string $sentryHost
     * @return \Micronative\ObjectFactory\Log\Monolog\MonologConfigInterface
     */
    public function setSentryHost(string $sentryHost = null): MonologConfigInterface
    {
        $this->sentryHost = $sentryHost;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getSentryProjectId(): string
    {
        return $this->sentryProjectId;
    }
    
    /**
     * @param string $sentryProjectId
     * @return \Micronative\ObjectFactory\Log\Monolog\MonologConfigInterface
     */
    public function setSentryProjectId(string $sentryProjectId = null): MonologConfigInterface
    {
        $this->sentryProjectId = $sentryProjectId;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getConfigName(): string
    {
        return $this->configName;
    }
    
    /**
     * @param string $configName
     * @return \Micronative\ObjectFactory\Log\Monolog\MonologConfigInterface
     */
    public function setConfigName(string $configName = null): MonologConfigInterface
    {
        $this->configName = $configName;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getSentryEnvironment(): string
    {
        return $this->sentryEnvironment;
    }
    
    /**
     * @param string $sentryEnvironment
     * @return \Micronative\ObjectFactory\Log\Monolog\MonologConfigInterface
     */
    public function setSentryEnvironment(string $sentryEnvironment = null): MonologConfigInterface
    {
        $this->sentryEnvironment = $sentryEnvironment;
        
        return $this;
    }
    
}
