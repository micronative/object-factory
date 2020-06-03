<?php

namespace Micronative\ObjectFactory\Test\Aws\Sns;

use Micronative\ObjectFactory\Aws\Sns\SnsConfig;
use PHPUnit\Framework\TestCase;

class SnsConfigTest extends TestCase
{
    /** @var string */
    protected $connectionName;
    
    /** @var array */
    protected $configArray;
    
    /** @var \Micronative\ObjectFactory\Aws\Sns\SnsConfig */
    protected $config;
    
    public function setUp()
    {
        parent::setUp();
        
        $this->connectionName = 'sns.ms.crm';
        $this->configArray    = [
            'key'    => 'configKey',
            'secret' => 'configSecret',
            'region' => 'configRegion',
        ];
        $this->config         = new SnsConfig($this->connectionName, $this->configArray);
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
    public function testSnsConfig()
    {
        $this->config->setConnectionName($this->connectionName)
                     ->setKey($this->configArray['key'])
                     ->setRegion($this->configArray['region'])
                     ->setSecret($this->configArray['secret']);
        
        $this->assertEquals($this->connectionName, $this->config->getConnectionName());
        $this->assertEquals($this->configArray['key'], $this->config->getKey());
        $this->assertEquals($this->configArray['region'], $this->config->getRegion());
        $this->assertEquals($this->configArray['secret'], $this->config->getSecret());
        $this->assertEquals($this->configArray, $this->config->toArray());
        
    }
}