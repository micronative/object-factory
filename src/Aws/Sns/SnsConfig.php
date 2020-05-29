<?php

declare(strict_types=1);

namespace Micronative\ObjectFactory\Aws\Sns;

class SnsConfig implements SnsConfigInterface
{
    
    /** @var string */
    protected $connectionName;
    
    /** @var string $key aws key */
    protected $key;
    
    /** @var string $secret aws secret */
    protected $secret;
    
    /** @var string $region aws region */
    protected $region;
    
    /**
     * SqsConfig constructor.
     *
     * @param string|null $connectionName
     * @param array|null $config
     */
    public function __construct(?string $connectionName = null, ?array $config = null)
    {
        $this->connectionName = $connectionName;
        $this->key            = $config['key'] ?? null;
        $this->secret         = $config['secret'] ?? null;
        $this->region         = $config['region'] ?? null;
    }
    
    /**
     * @return string[]
     */
    public function toArray(): array
    {
        return [
            'key'    => $this->key,
            'secret' => $this->secret,
            'region' => $this->region,
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
     * @return SnsConfigInterface
     */
    public function setConnectionName(string $connectionName): SnsConfigInterface
    {
        $this->connectionName = $connectionName;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }
    
    /**
     * @param string $key
     * @return SnsConfigInterface
     */
    public function setKey(string $key): SnsConfigInterface
    {
        $this->key = $key;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getSecret(): string
    {
        return $this->secret;
    }
    
    /**
     * @param string $secret
     * @return SnsConfigInterface
     */
    public function setSecret(string $secret): SnsConfigInterface
    {
        $this->secret = $secret;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getRegion(): string
    {
        return $this->region;
    }
    
    /**
     * @param string $region
     * @return SnsConfigInterface
     */
    public function setRegion(string $region): SnsConfigInterface
    {
        $this->region = $region;
        
        return $this;
    }
}
