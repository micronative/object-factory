<?php

namespace Micronative\ObjectFactory\Log\Monolog;

use Micronative\ObjectFactory\Log\Monolog\Exceptions\MonologConfigException;
use Micronative\ServiceSchema\Json\JsonReader;

class MonologConfigFactory
{

    /** @var string|null */
    protected $configFile;

    /** @var \stdClass */
    protected $configs;

    /**
     * MonologConfigFactory constructor.
     *
     * @param string|null $configFile
     * @throws \Micronative\ObjectFactory\Log\Monolog\Exceptions\MonologConfigException
     * @throws \Micronative\ServiceSchema\Json\Exception\JsonException
     */
    public function __construct(?string $configFile = null)
    {
        $this->configFile = $configFile;
        $this->loadConfigs();
    }

    /**
     * @throws \Micronative\ObjectFactory\Log\Monolog\Exceptions\MonologConfigException
     * @throws \Micronative\ServiceSchema\Json\Exception\JsonException
     */
    protected function loadConfigs(): void
    {
        if (!is_file($this->configFile)) {
            throw new MonologConfigException(MonologConfigException::INVALID_CONFIG_FILE . $this->configFile);
        }

        $this->configs = JsonReader::decode(JsonReader::read($this->configFile));
    }

    /**
     * @param string|null $configName
     * @return \Micronative\ObjectFactory\Log\Monolog\MonologConfig
     * @throws \Micronative\ObjectFactory\Log\Monolog\Exceptions\MonologConfigException
     */
    public function get(?string $configName = null): MonologConfig
    {
        if (!isset($this->configs->$configName)) {
            throw new MonologConfigException(MonologConfigException::INVALID_CONNECTION_NAME . $configName);
        }

        $configObject = $this->configs->$configName;
        $configArray = [];

        foreach ($configObject as $key => $para) {
            $configArray[$key] = getenv($para);
        }

        return new MonologConfig($configName, $configArray);
    }
}
