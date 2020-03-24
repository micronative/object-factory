<?php

namespace Micronative\ObjectFactory\Aws\Sqs;

class SqsClientFactory
{

    /** @var string */
    protected $configFile;

    /** @var \Micronative\ObjectFactory\Aws\Sqs\SqsConfigFactory */
    protected $configFactory;

    /**
     * SqsClientFactory constructor.
     *
     * @param string|null $configFile
     * @throws \Micronative\ObjectFactory\Aws\Sqs\Exceptions\SqsConfigException
     * @throws \Micronative\ServiceSchema\Json\Exception\JsonException
     */
    public function __construct(?string $configFile = null)
    {
        $this->configFile = $configFile;
        $this->configFactory = new SqsConfigFactory($this->configFile);
    }

    /**
     * @param string|null $connectionName
     * @return \Micronative\ObjectFactory\Aws\Sqs\SqsClientInterface
     * @throws \Micronative\ObjectFactory\Aws\Sqs\Exceptions\SqsConfigException
     */
    public function create(?string $connectionName = null): SqsClientInterface
    {
        /** @var \Micronative\ObjectFactory\Aws\Sqs\SqsConfig $config */
        $config = $this->configFactory->get($connectionName);

        return new SqsClient($config);
    }

}
