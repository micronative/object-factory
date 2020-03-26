<?php

namespace Micronative\Test\Aws\Sns;

use Micronative\ObjectFactory\Aws\Sns\SnsConfig;
use PHPUnit\Framework\TestCase;


class SnsConfigTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    /**
     * @covers \Micronative\ObjectFactory\Aws\Sns\SnsConfig::getSecret
     * @covers \Micronative\ObjectFactory\Aws\Sns\SnsConfig::getRegion
     * @covers \Micronative\ObjectFactory\Aws\Sns\SnsConfig::getConnectionName
     * @covers \Micronative\ObjectFactory\Aws\Sns\SnsConfig::getKey
     * @covers \Micronative\ObjectFactory\Aws\Sns\SnsConfig::setSecret
     * @covers \Micronative\ObjectFactory\Aws\Sns\SnsConfig::setRegion
     * @covers \Micronative\ObjectFactory\Aws\Sns\SnsConfig::setConnectionName
     * @covers \Micronative\ObjectFactory\Aws\Sns\SnsConfig::setKey
     * @covers \Micronative\ObjectFactory\Aws\Sns\SnsConfig::toArray
     */
    public function testConfig()
    {
        $connectionName = 'sns.ms.crm';
        $configArray = [
            'key' => 'configKey',
            'secret' => 'configSecret',
            'region' => 'configRegion'
        ];
        $config = new SnsConfig($connectionName, $configArray);
        $config->setConnectionName($connectionName)
            ->setKey($configArray['key'])
            ->setRegion($configArray['region'])
            ->setSecret($configArray['secret']);

        $this->assertEquals($connectionName, $config->getConnectionName());
        $this->assertEquals($configArray['key'], $config->getKey());
        $this->assertEquals($configArray['region'], $config->getRegion());
        $this->assertEquals($configArray['secret'], $config->getSecret());
        $this->assertEquals($configArray, $config->toArray());

    }
}