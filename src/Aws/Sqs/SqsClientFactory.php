<?php

namespace Micronative\Aws\Sqs;

class SqsClientFactory
{

    /** @var string */
    protected $configFile;

    /** @var \Micronative\Aws\Sqs\SqsConfigFactory */
    protected $configFactory;

    /**
     * SqsClientFactory constructor.
     *
     * @param string|null $configFile
     * @throws \Micronative\Aws\Sqs\Exceptions\SqsConfigException
     * @throws \ServiceSchema\Json\Exception\JsonException
     */
    public function __construct(?string $configFile = null)
    {
        $this->configFile = $configFile;
        $this->configFactory = new SqsConfigFactory($this->configFile);
    }

    /**
     * @param string|null $connectionName
     * @return \Micronative\Aws\Sqs\SqsClientInterface
     * @throws \Micronative\Aws\Sqs\Exceptions\SqsConfigException
     */
    public function create(?string $connectionName = null): SqsClientInterface
    {
        /** @var \Micronative\Aws\Sqs\SqsConfig $config */
        $config = $this->configFactory->get($connectionName);

        return new SqsClient($config);
    }

}
