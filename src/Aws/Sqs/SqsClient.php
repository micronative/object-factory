<?php

namespace Micronative\Aws\Sqs;

use Micronative\Sqs\SqsConnectionFactory;
use Micronative\Sqs\SqsConsumer;
use Micronative\Sqs\SqsContext;
use Micronative\Sqs\SqsDestination;
use Micronative\Sqs\SqsMessage;

class SqsClient implements SqsClientInterface
{
    /** @var \Micronative\Aws\Sqs\SqsConfig */
    protected $config;

    /** @var \Micronative\Sqs\SqsConnectionFactory */
    protected $factory;

    /** @var \Micronative\Sqs\SqsContext */
    protected $context;

    /** @var \Micronative\Sqs\SqsDestination */
    protected $queue;

    /** @var \Micronative\Sqs\SqsConsumer */
    protected $consumer;

    /**
     * SqsClient constructor.
     *
     * @param \Micronative\Aws\Sqs\SqsConfig|null $config config
     */
    public function __construct(SqsConfig $config = null)
    {
        $this->config = $config;
        $this->factory = new SqsConnectionFactory($this->config->toArray());
        $this->context = $this->factory->createContext();
        $this->queue = $this->context->createQueue($this->config->getQueue());
        $this->queue->setFifoQueue($this->config ->isFifo());
        $this->consumer = $this->context->createConsumer($this->queue);
    }

    /**
     * @param string $body
     * @param string $groupId
     * @param array|null $properties
     * @return \Micronative\Sqs\SqsMessage|null
     * @throws \Interop\Queue\Exception
     * @throws \Interop\Queue\Exception\InvalidDestinationException
     * @throws \Interop\Queue\Exception\InvalidMessageException
     */
    public function publish(string $body, string $groupId, array $properties = [])
    {
        $message = $this->context->createMessage($body, $properties);
        $message->setMessageGroupId($groupId);

        $this->context->createProducer()->send($this->queue, $message);

        return $message;
    }

    /**
     * @param int $timeOut millisecond
     * @return \Micronative\Sqs\SqsMessage|null
     */
    public function receive(int $timeOut = 1000)
    {
        return $this->consumer->receive($timeOut);
    }

    /**
     * @param \Micronative\Sqs\SqsMessage|null $message
     * @return mixed|void
     */
    public function acknowledge(SqsMessage $message = null)
    {
        $this->consumer->acknowledge($message);
    }

    public function reject(SqsMessage $message = null, bool $requeue = false)
    {
        $this->consumer->reject($message, $requeue);
    }

    /**
     * @return \Micronative\Aws\Sqs\SqsConfig
*/
    public function getConfig(): SqsConfig
    {
        return $this->config;
    }

    /**
     * @param \Micronative\Aws\Sqs\SqsConfig $config
     * @return \Micronative\Aws\Sqs\SqsClient
     */
    public function setConfig(SqsConfig $config): SqsClient
    {
        $this->config = $config;

        return $this;
    }

    /**
     * @return \Micronative\Sqs\SqsConnectionFactory
     */
    public function getFactory(): SqsConnectionFactory
    {
        return $this->factory;
    }

    /**
     * @param \Micronative\Sqs\SqsConnectionFactory $factory
     * @return \Micronative\Aws\Sqs\SqsClient
     */
    public function setFactory(SqsConnectionFactory $factory): SqsClient
    {
        $this->factory = $factory;

        return $this;
    }

    /**
     * @return \Micronative\Sqs\SqsContext
     */
    public function getContext(): SqsContext
    {
        return $this->context;
    }

    /**
     * @param \Micronative\Sqs\SqsContext $context
     * @return \Micronative\Aws\Sqs\SqsClient
     */
    public function setContext(SqsContext $context): SqsClient
    {
        $this->context = $context;

        return $this;
    }

    /**
     * @return \Micronative\Sqs\SqsDestination
     */
    public function getQueue(): SqsDestination
    {
        return $this->queue;
    }

    /**
     * @param \Micronative\Sqs\SqsDestination $queue
     * @return \Micronative\Aws\Sqs\SqsClient
     */
    public function setQueue(SqsDestination $queue): SqsClient
    {
        $this->queue = $queue;

        return $this;
    }

    /**
     * @return \Micronative\Sqs\SqsConsumer
     */
    public function getConsumer(): SqsConsumer
    {
        return $this->consumer;
    }

    /**
     * @param \Micronative\Sqs\SqsConsumer $consumer
     * @return \Micronative\Aws\Sqs\SqsClient
     */
    public function setConsumer(SqsConsumer $consumer): SqsClient
    {
        $this->consumer = $consumer;

        return $this;
    }

}
