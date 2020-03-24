<?php

declare(strict_types = 1);

namespace Micronative\ObjectFactory\Aws\Sqs;

use Micronative\ObjectFactory\Aws\Sqs\Exceptions\SqsConfigException;
use Micronative\ServiceSchema\Json\JsonReader;

class SqsConfigFactory
{

    /** @var string|null */
    protected $configFile;

    /** @var \stdClass */
    protected $configs;

    /**
     * SqsConfigFactory constructor.
     *
     * @param string|null $configFile
     * @throws \Micronative\ObjectFactory\Aws\Sqs\Exceptions\SqsConfigException
     * @throws \Micronative\ServiceSchema\Json\Exception\JsonException
     */
    public function __construct(?string $configFile = null)
    {
        $this->configFile = $configFile;
        $this->loadConfigs();
    }

    /**
     * @throws \Micronative\ObjectFactory\Aws\Sqs\Exceptions\SqsConfigException
     * @throws \Micronative\ServiceSchema\Json\Exception\JsonException
     */
    protected function loadConfigs(): void
    {
        if (!is_file($this->configFile)) {
            throw new SqsConfigException(SqsConfigException::INVALID_CONFIG_FILE . $this->configFile);
        }

        $this->configs = JsonReader::decode(JsonReader::read($this->configFile));
    }

    /**
     * @param string|null $connectionName
     * @return \Micronative\ObjectFactory\Aws\Sqs\SqsConfig
     * @throws \Micronative\ObjectFactory\Aws\Sqs\Exceptions\SqsConfigException
     */
    public function get(?string $connectionName = null): SqsConfig
    {
        if (!isset($this->configs->$connectionName)) {
            throw new SqsConfigException(SqsConfigException::INVALID_CONNECTION_NAME . $connectionName);
        }

        $configObject = $this->configs->$connectionName;
        $configArray = [];

        foreach ($configObject as $key => $para) {
            $configArray[$key] = getenv($para);
        }

        return new SqsConfig($connectionName, $configArray);
    }

}
