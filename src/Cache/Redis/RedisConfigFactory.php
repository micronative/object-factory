<?php

namespace Micronative\ObjectFactory\Cache\Redis;

use Micronative\ObjectFactory\Cache\Redis\Exceptions\RedisConfigException;
use Micronative\ServiceSchema\Json\JsonReader;

class RedisConfigFactory
{

    /** @var string|null */
    protected $configFile;

    /** @var \stdClass */
    protected $configs;

    public const REDIS_CONNECTION_CRM = 'redis.ms.crm';

    /**
     * RedisConfigFactory constructor.
     *
     * @param string|null $configFile
     * @throws \Micronative\ObjectFactory\Cache\Redis\Exceptions\RedisConfigException
     * @throws \Micronative\ServiceSchema\Json\Exception\JsonException
     */
    public function __construct(?string $configFile = null)
    {
        $this->configFile = $configFile;
        $this->loadConfigs();
    }

    /**
     * @throws \Micronative\ObjectFactory\Cache\Redis\Exceptions\RedisConfigException
     * @throws \Micronative\ServiceSchema\Json\Exception\JsonException
     */
    protected function loadConfigs(): void
    {
        if (!is_file($this->configFile)) {
            throw new RedisConfigException(RedisConfigException::INVALID_CONFIG_FILE . $this->configFile);
        }

        $this->configs = JsonReader::decode(JsonReader::read($this->configFile));
    }

    /**
     * @param string|null $connection
     * @return \Micronative\ObjectFactory\Cache\Redis\RedisConfig
     * @throws \Micronative\ObjectFactory\Cache\Redis\Exceptions\RedisConfigException
     */
    public function get(?string $connection = null): RedisConfig
    {
        if (!isset($this->configs->$connection)) {
            throw new RedisConfigException(RedisConfigException::INVALID_CONNECTION_NAME . $connection);
        }

        $configObject = $this->configs->$connection;
        $configArray = [];

        foreach ($configObject as $key => $para) {
            $configArray[$key] = getenv($para);
        }

        return new RedisConfig($configArray);
    }

}
