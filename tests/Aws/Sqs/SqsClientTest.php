<?php

namespace Micronative\Test\Aws\Sqs;

use Aws\Result;
use Micronative\ObjectFactory\Aws\Sqs\SqsClient;
use Micronative\ObjectFactory\Aws\Sqs\SqsConfigFactory;
use Micronative\ServiceSchema\Json\JsonReader;
use Micronative\Sqs\SqsClient as QueueClient;
use Micronative\Sqs\SqsConnectionFactory;
use Micronative\Sqs\SqsConsumer;
use Micronative\Sqs\SqsContext;
use Micronative\Sqs\SqsDestination;
use Micronative\Sqs\SqsMessage;
use Micronative\Sqs\SqsProducer;
use PHPUnit\Framework\TestCase;

class SqsClientTest extends TestCase
{
    /** @var string */
    protected $testDir;

    /** @var string */
    protected $configFile;

    /** @var \Micronative\ObjectFactory\Aws\Sqs\SqsConfigFactory */
    protected $configFactory;

    /** @var \Micronative\ObjectFactory\Aws\Sqs\SqsConfig */
    protected $config;

    /** @var \Micronative\ObjectFactory\Aws\Sqs\SqsClient */
    protected $sqsClient;

    /** @var \Micronative\Sqs\SqsConnectionFactory|\PHPUnit\Framework\MockObject\MockObject */
    protected $mockFactory;

    /** @var \Micronative\Sqs\SqsContext|\PHPUnit\Framework\MockObject\MockObject */
    protected $mockContext;

    /** @var \Micronative\Sqs\SqsDestination|\PHPUnit\Framework\MockObject\MockObject */
    protected $mockQueue;

    /** @var \Micronative\Sqs\SqsConsumer|\PHPUnit\Framework\MockObject\MockObject */
    protected $mockConsumer;

    /** @var \Micronative\Sqs\SqsMessage|\PHPUnit\Framework\MockObject\MockObject */
    protected $mockMessage;

    /**
     * @throws \Micronative\ObjectFactory\Aws\Sqs\Exceptions\SqsConfigException
     * @throws \Micronative\ServiceSchema\Json\Exception\JsonException
     */
    public function setUp()
    {
        parent::setUp();

        $this->testDir = dirname(dirname(dirname(__FILE__)));
        $this->configFile = $this->testDir . '/configs/sqs.configs.json';
        $this->putEnvVariables($this->configFile);
        $this->configFactory = new SqsConfigFactory($this->configFile);
        $this->config = $this->configFactory->get('sqs.ms.crm');
        $this->sqsClient = new SqsClient($this->config);

        $this->mockFactory = $this->createMock(SqsConnectionFactory::class);
        $this->mockContext = $this->createMock(SqsContext::class);
        $this->mockQueue = $this->createMock(SqsDestination::class);
        $this->mockConsumer = $this->createMock(SqsConsumer::class);
        $this->mockMessage = $this->createMock(SqsMessage::class);

        $this->sqsClient
            ->setConfig($this->config)
            ->setQueue($this->mockQueue)
            ->setConsumer($this->mockConsumer)
            ->setContext($this->mockContext)
            ->setFactory($this->mockFactory);
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

    public function testSettersAndGetters()
    {
        $this->sqsClient
            ->setConfig($this->config)
            ->setQueue($this->mockQueue)
            ->setConsumer($this->mockConsumer)
            ->setContext($this->mockContext)
            ->setFactory($this->mockFactory);

        $this->assertSame($this->sqsClient->getConfig(), $this->config);
        $this->assertSame($this->sqsClient->getQueue(), $this->mockQueue);
        $this->assertSame($this->sqsClient->getConsumer(), $this->mockConsumer);
        $this->assertSame($this->sqsClient->getContext(), $this->mockContext);
        $this->assertSame($this->sqsClient->getFactory(), $this->mockFactory);
    }

    /**
     * @covers \Micronative\ObjectFactory\Aws\Sqs\SqsClient::publish
     * @throws \Interop\Queue\Exception
     * @throws \Interop\Queue\Exception\InvalidDestinationException
     * @throws \Interop\Queue\Exception\InvalidMessageException
     */
    public function testPublish()
    {

        $body = "body";
        $groupId = "groupId";
        $properties = [];
        $producer = new SqsProducer($this->mockContext);
        $resultArray = ['MessageId' => 'someId'];
        $awsResult = new Result($resultArray);

        $mockClient = $this->createMock(QueueClient::class);
        $mockClient->method('sendMessage')->willReturn($awsResult);

        $this->mockContext->method('createProducer')->willReturn($producer);
        $this->mockContext->method('getSqsClient')->willReturn($mockClient);
        $this->mockContext->method('createMessage')->willReturn($this->mockMessage);
        $this->mockContext->method('getQueueUrl')->willReturn('url');

        $this->mockMessage->method('getBody')->willReturn($body);
        $this->mockMessage->method('getDelaySeconds')->willReturn(100);
        $this->mockMessage->method('getMessageDeduplicationId')->willReturn(true);
        $this->mockMessage->method('getMessageGroupId')->willReturn($groupId);
        $this->mockMessage->method('getHeaders')->willReturn([]);
        $this->mockMessage->method('getProperties')->willReturn([]);
        $this->mockQueue->method('getRegion')->willReturn('ap-southeast-2');

        $this->mockContext
            ->expects($this->once())->method('createMessage')
            ->with($body, $properties)
            ->willReturn($this->mockMessage);

        $this->mockContext->expects($this->once())->method('createProducer')
            ->willReturn($producer);

        $mockClient->expects($this->once())->method('sendMessage')->willReturn($awsResult);
        $this->mockMessage->expects($this->once())->method('setMessageId')->with($resultArray['MessageId']);
        $this->sqsClient->publish($body, $groupId, $properties);
    }

    /**
     * @covers \Micronative\ObjectFactory\Aws\Sqs\SqsClient::receive
     */
    public function testReceive()
    {
        $timeout = 1000;
        $this->mockConsumer->expects($this->once())->method('receive')->with($timeout);
        $this->sqsClient->receive($timeout);
    }

    /**
     * @covers \Micronative\ObjectFactory\Aws\Sqs\SqsClient::acknowledge
     */
    public function testAcknowledge()
    {
        $this->mockConsumer->expects($this->once())->method('acknowledge')->with($this->mockMessage);
        $this->sqsClient->acknowledge($this->mockMessage);
    }

    /**
     * @covers \Micronative\ObjectFactory\Aws\Sqs\SqsClient::reject
     */
    public function testReject()
    {
        $requeue = false;
        $this->mockConsumer->expects($this->once())->method('reject')->with($this->mockMessage, $requeue);
        $this->sqsClient->reject($this->mockMessage, $requeue);
    }
}