<?php

namespace Micronative\Aws\Sns;

class SnsClientFactory
{

    /** @var string */
    protected $configFile;

    /** @var \Micronative\Aws\Sns\SnsConfigFactory */
    protected $configFactory;

    /**
     * SqsClientFactory constructor.
     *
     * @param string|null $configFile
     * @throws \Micronative\Aws\Sns\Exceptions\SnsConfigException
     * @throws \ServiceSchema\Json\Exception\JsonException
     */
    public function __construct(?string $configFile = null)
    {
        $this->configFile = $configFile;
        $this->configFactory = new SnsConfigFactory($this->configFile);
    }

    /**
     * @param string|null $connectionName
     * @return \Micronative\Aws\Sns\SnsClientInterface
     * @throws \Micronative\Aws\Sns\Exceptions\SnsConfigException
     */
    public function create(?string $connectionName = null): SnsClientInterface
    {
        /** @var \Micronative\Aws\Sns\SnsConfig $config */
        $config = $this->configFactory->get($connectionName);

        return new SnsClient($config);
    }

}
