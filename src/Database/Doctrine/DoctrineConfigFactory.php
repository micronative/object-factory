<?php

namespace Micronative\ObjectFactory\Database\Doctrine;

use Micronative\ObjectFactory\Database\Doctrine\Exceptions\DoctrineConfigException;
use ServiceSchema\Json\JsonReader;

class DoctrineConfigFactory
{

    /** @var string|null */
    protected $configFile;

    /** @var \stdClass */
    protected $configs;

    public const DOCTRINE_CONNECTION_CRM = 'doctrine.ms.crm';

    /**
     * DoctrineConfigFactory constructor.
     *
     * @param string|null $configFile
     * @throws \Micronative\ObjectFactory\Database\Doctrine\Exceptions\DoctrineConfigException
     * @throws \ServiceSchema\Json\Exception\JsonException
     */
    public function __construct(?string $configFile = null)
    {
        $this->configFile = $configFile;
        $this->loadConfigs();
    }

    /**
     * @throws \Micronative\ObjectFactory\Database\Doctrine\Exceptions\DoctrineConfigException
     * @throws \ServiceSchema\Json\Exception\JsonException
     */
    protected function loadConfigs(): void
    {
        if (!is_file($this->configFile)) {
            throw new DoctrineConfigException(DoctrineConfigException::INVALID_CONFIG_FILE . $this->configFile);
        }

        $this->configs = JsonReader::decode(JsonReader::read($this->configFile));
    }

    /**
     * @param string|null $connectionName
     * @return \Micronative\ObjectFactory\Database\Doctrine\DoctrineConfig
     * @throws \Micronative\ObjectFactory\Database\Doctrine\Exceptions\DoctrineConfigException
     */
    public function get(?string $connectionName = null): DoctrineConfig
    {
        if (!isset($this->configs->$connectionName)) {
            throw new DoctrineConfigException(DoctrineConfigException::INVALID_CONNECTION_NAME . $connectionName);
        }

        $configObject = $this->configs->$connectionName;
        $configArray = [];

        foreach ($configObject as $key => $para) {
            $configArray[$key] = getenv($para);
        }

        return new DoctrineConfig($connectionName, $configArray);
    }
}
