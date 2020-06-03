<?php

namespace Micronative\ObjectFactory\Aws\Sns;

use Micronative\Sns\SnsConnectionFactory;
use Micronative\Sns\SnsContext;

class SnsClient implements SnsClientInterface
{
    
    /** @var \Micronative\ObjectFactory\Aws\Sns\SnsConfigInterface */
    protected $config;
    
    /** @var \Micronative\Sns\SnsConnectionFactory */
    protected $factory;
    
    /** @var \Micronative\Sns\SnsContext */
    protected $context;
    
    /**
     * SqsClient constructor.
     *
     * @param \Micronative\ObjectFactory\Aws\Sns\SnsConfigInterface|null $config config
     */
    public function __construct(SnsConfigInterface $config = null)
    {
        $this->config  = $config;
        $this->factory = new SnsConnectionFactory($this->config->toArray());
        $this->context = $this->factory->createContext();
    }
    
    /**
     * @param string $topicName topic name
     * @param string $body message body
     * @param array $properties messqage properties
     * @return \Micronative\Sns\SnsMessage|\Interop\Queue\Message|mixed
     * @throws \Interop\Queue\Exception
     * @throws \Interop\Queue\Exception\InvalidDestinationException
     * @throws \Interop\Queue\Exception\InvalidMessageException
     */
    public function send(string $topicName, string $body, array $properties = [])
    {
        $topic = $this->context->createTopic($topicName);
        $this->context->declareTopic($topic);
        
        $message = $this->context->createMessage($body, $properties);
        $this->context->createProducer()->send($topic, $message);
        
        return $message;
    }
    
    /**
     * @return \Micronative\ObjectFactory\Aws\Sns\SnsConfigInterface
     */
    public function getConfig(): SnsConfigInterface
    {
        return $this->config;
    }
    
    /**
     * @param \Micronative\ObjectFactory\Aws\Sns\SnsConfigInterface $config
     * @return \Micronative\ObjectFactory\Aws\Sns\SnsClientInterface
     */
    public function setConfig(SnsConfigInterface $config): SnsClientInterface
    {
        $this->config = $config;
        
        return $this;
    }
    
    /**
     * @return \Micronative\Sns\SnsConnectionFactory
     */
    public function getFactory(): SnsConnectionFactory
    {
        return $this->factory;
    }
    
    /**
     * @param \Micronative\Sns\SnsConnectionFactory $factory
     * @return \Micronative\ObjectFactory\Aws\Sns\SnsClientInterface
     */
    public function setFactory(SnsConnectionFactory $factory): SnsClientInterface
    {
        $this->factory = $factory;
        
        return $this;
    }
    
    /**
     * @return \Micronative\Sns\SnsContext
     */
    public function getContext(): SnsContext
    {
        return $this->context;
    }
    
    /**
     * @param \Micronative\Sns\SnsContext $context
     * @return \Micronative\ObjectFactory\Aws\Sns\SnsClientInterface
     */
    public function setContext(SnsContext $context): SnsClientInterface
    {
        $this->context = $context;
        
        return $this;
    }
    
}
