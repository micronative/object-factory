<?php

namespace Micronative\Test\Aws\Sns;

use Micronative\ObjectFactory\Aws\Sns\SnsClient;
use Micronative\ObjectFactory\Aws\Sns\SnsClientFactory;
use Micronative\ObjectFactory\Aws\Sns\SnsConfig;
use Micronative\ServiceSchema\Json\JsonReader;
use Micronative\Sns\SnsConnectionFactory;
use Micronative\Sns\SnsContext;
use Micronative\Sns\SnsProducer;
use PHPUnit\Framework\TestCase;

class SnsClientTest extends TestCase
{
    /** @var string */
    protected $testDir;
    
    /** @var string */
    protected $configFile;
    
    /** @var $snsClient SnsClient */
    protected $snsClient;
    
    /** @var \PHPUnit\Framework\MockObject\MockObject */
    protected $snsProducerMock;
    
    /** @var \PHPUnit\Framework\MockObject\MockObject */
    protected $snsContextMock;
    
    /**
     * @throws \Micronative\ObjectFactory\Aws\Sns\Exceptions\SnsConfigException
     * @throws \Micronative\ServiceSchema\Json\Exception\JsonException
     */
    public function setUp()
    {
        parent::setUp();
        
        $this->testDir    = dirname(dirname(dirname(__FILE__)));
        $this->configFile = $this->testDir . '/configs/sns.configs.json';
        $this->putEnvVariables($this->configFile);
        $snsClientFactory = new SnsClientFactory($this->configFile);
        $this->snsClient  = $snsClientFactory->create('sns.ms.crm');
        
        $this->snsProducerMock = $this->createMock(SnsProducer::class);
        $this->snsProducerMock->method('send')->willReturn('MessageId');
    }
    
    /**
     * @param $configFile
     * @throws \Micronative\ServiceSchema\Json\Exception\JsonException
     */
    protected function putEnvVariables($configFile)
    {
        $configArrays = JsonReader::decode(JsonReader::read($configFile));
        
        foreach ($configArrays as $configArray) {
            foreach ($configArray as $key => $value) {
                putenv((string)$value . '=' . $value);
            }
        }
    }
    
    public function testGetterSetter()
    {
        $config               = [
            'key'    => 'CRM_AWS_KEY',
            'secret' => 'CRM_AWS_SECRET',
            'region' => 'CRM_AWS_REGION',
        ];
        $configMock           = new SnsConfig('sns.ms.crm', $config);
        $snsConnectionFactory = $this->createMock(SnsConnectionFactory::class);
        $this->snsClient->setFactory($snsConnectionFactory);
        $this->snsClient->setConfig($configMock);
        
        $this->assertEquals($config, $this->snsClient->getConfig()->toArray());
        $this->assertEquals($config['key'], $this->snsClient->getConfig()->getKey());
        $this->assertEquals($config['secret'], $this->snsClient->getConfig()->getSecret());
        $this->assertEquals($config['region'], $this->snsClient->getConfig()->getRegion());
    }
    
    /**
     * @throws \Micronative\ServiceSchema\Json\Exception\JsonException
     */
    public function testConfig()
    {
        $snsClientConfig = $this->snsClient->getConfig()->toArray();
        $configContents  = JsonReader::decode(JsonReader::read($this->configFile), true);
        $configContents  = $configContents['sns.ms.crm'];
        
        foreach ($configContents as $key => $confSetting) {
            $this->assertSame((string)$confSetting, (string)$snsClientConfig[$key]);
        }
    }
    
    public function testSend()
    {
        $topic                = 'topic';
        $body                 = 'Sample body';
        $properties           = ['property' => 1];
        $snsClientConfig      = $this->snsClient->getConfig()->toArray();
        $this->snsContextMock = $this->getMockBuilder(SnsContext::class)
                                     ->setConstructorArgs([$this->snsClient->getContext()->getSnsClient(),
                                                           $snsClientConfig])
                                     ->setMethods(['declareTopic', 'createProducer'])
                                     ->getMock();
        $this->snsContextMock->expects($this->exactly(1))->method('declareTopic');
        $this->snsContextMock->expects($this->exactly(1))->method('createProducer')->willReturn($this->snsProducerMock);
        $this->snsClient->setContext($this->snsContextMock);
        $this->snsClient->send($topic, $body, $properties);
    }
    
    public function testSendException()
    {
        $topic      = 'topic';
        $body       = 'Sample body';
        $properties = ['property' => 1];
        try {
            $this->snsClient->send($topic, $body, $properties);
        }
        catch (\Exception $exception) {
            $this->assertContains('Error executing "CreateTopic"', $exception->getMessage());
        }
    }
}