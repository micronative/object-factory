<?php

declare(strict_types = 1);

namespace Micronative\ObjectFactory\Aws\Sns;

use Micronative\ObjectFactory\Aws\Sns\Exceptions\SnsConfigException;
use Micronative\ServiceSchema\Json\JsonReader;

class SnsConfigFactory
{

    /** @var string|null */
    protected $configFile;

    /** @var \stdClass */
    protected $configs;

    /**
     * SqsConfigFactory constructor.
     *
     * @param string|null $configFile
     * @throws \Micronative\ObjectFactory\Aws\Sns\Exceptions\SnsConfigException
     * @throws \Micronative\ServiceSchema\Json\Exception\JsonException
     */
    public function __construct(?string $configFile = null)
    {
        $this->configFile = $configFile;
        $this->loadConfigs();
    }

    /**
     * @throws \Micronative\ObjectFactory\Aws\Sns\Exceptions\SnsConfigException
     * @throws \Micronative\ServiceSchema\Json\Exception\JsonException
     */
    protected function loadConfigs(): void
    {
        if (!is_file($this->configFile)) {
            throw new SnsConfigException(SnsConfigException::INVALID_CONFIG_FILE . $this->configFile);
        }

        $this->configs = JsonReader::decode(JsonReader::read($this->configFile));
    }

    /**
     * @param string|null $connectionName
     * @return \Micronative\ObjectFactory\Aws\Sns\SnsConfig
     * @throws \Micronative\ObjectFactory\Aws\Sns\Exceptions\SnsConfigException
     */
    public function get(?string $connectionName = null): SnsConfig
    {
        if (!isset($this->configs->$connectionName)) {
            throw new SnsConfigException(SnsConfigException::INVALID_CONNECTION_NAME . $connectionName);
        }

        $configObject = $this->configs->$connectionName;
        $configArray = [];

        foreach ($configObject as $key => $para) {
            $configArray[$key] = getenv($para);
        }

        return new SnsConfig($connectionName, $configArray);
    }

}
