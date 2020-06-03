<?php

namespace Micronative\ObjectFactory\Test\Aws\Sqs;

use Micronative\ObjectFactory\Aws\Sqs\SqsConfig;
use PHPUnit\Framework\TestCase;

class SqsConfigTest extends TestCase
{
    /** @var string */
    protected $connectionName;
    
    /** @var array */
    protected $configArray;
    
    /** @var \Micronative\ObjectFactory\Aws\Sqs\SqsConfig */
    protected $config;
    
    public function setUp()
    {
        parent::setUp();
        
        $this->connectionName = 'sqs.ms.crm';
        $this->configArray    = [
            'key'    => 'sqsKey',
            'secret' => 'sqsSecret',
            'region' => 'sqsRegion',
            'queue'  => 'sqsQueue',
            'fifo'   => false,
        ];
        $this->config         = new SqsConfig($this->connectionName, $this->configArray);
    }
    
    /**
     * @covers \Micronative\ObjectFactory\Aws\Sqs\SqsConfig::getSecret
     * @covers \Micronative\ObjectFactory\Aws\Sqs\SqsConfig::getRegion
     * @covers \Micronative\ObjectFactory\Aws\Sqs\SqsConfig::getConnectionName
     * @covers \Micronative\ObjectFactory\Aws\Sqs\SqsConfig::getKey
     * @covers \Micronative\ObjectFactory\Aws\Sqs\SqsConfig::getQueue
     * @covers \Micronative\ObjectFactory\Aws\Sqs\SqsConfig::isFifo
     * @covers \Micronative\ObjectFactory\Aws\Sqs\SqsConfig::setSecret
     * @covers \Micronative\ObjectFactory\Aws\Sqs\SqsConfig::setRegion
     * @covers \Micronative\ObjectFactory\Aws\Sqs\SqsConfig::setConnectionName
     * @covers \Micronative\ObjectFactory\Aws\Sqs\SqsConfig::setKey
     * @covers \Micronative\ObjectFactory\Aws\Sqs\SqsConfig::setQueue
     * @covers \Micronative\ObjectFactory\Aws\Sqs\SqsConfig::setFifo
     * @covers \Micronative\ObjectFactory\Aws\Sqs\SqsConfig::toArray
     */
    public function testSqsConfig()
    {
        $this->config->setConnectionName($this->connectionName)
                     ->setKey($this->configArray['key'])
                     ->setRegion($this->configArray['region'])
                     ->setSecret($this->configArray['secret'])
                     ->setQueue($this->configArray['queue'])
                     ->setFifo($this->configArray['fifo']);
        
        $this->assertEquals($this->connectionName, $this->config->getConnectionName());
        $this->assertEquals($this->configArray['key'], $this->config->getKey());
        $this->assertEquals($this->configArray['region'], $this->config->getRegion());
        $this->assertEquals($this->configArray['secret'], $this->config->getSecret());
        $this->assertEquals($this->configArray['queue'], $this->config->getQueue());
        $this->assertEquals($this->configArray['fifo'], $this->config->isFifo());
        $this->assertEquals($this->configArray, $this->config->toArray());
        
    }
}