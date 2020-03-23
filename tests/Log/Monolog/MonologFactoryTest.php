<?php

namespace Brighte\Tests\Infrastructure\Log\Monolog;

use Micronative\ObjectFactory\Log\Monolog\MonologFactory;
use Monolog\Logger;
use PHPUnit\Framework\TestCase;

class MonologFactoryTest extends TestCase
{

    /** @var string */
    protected $testDir;

    /** @var \Micronative\ObjectFactory\Log\Monolog\MonologConfigFactory */
    protected $configFactory;

    /** @var \Micronative\ObjectFactory\Log\Monolog\MonologFactory */
    protected $monologFactory;

    /**
     * @throws \Micronative\ObjectFactory\Log\Monolog\Exceptions\MonologConfigException
     * @throws \ServiceSchema\Json\Exception\JsonException
     */
    public function setUp()
    {
        parent::setUp();
        putenv('APP_NAME=name');
        putenv('APP_LOG_PATH=path');
        putenv('APP_LOG_LEVEL=100');
        putenv('APP_LOG_SENTRY=true');
        putenv('SENTRY_DSN=https://somerandomstring:somemorerandomstring@sentry.io/randomnumber');
        putenv('SENTRY_PUBLIC_KEY=public_key');
        putenv('SENTRY_HOST=host');
        putenv('SENTRY_PROJECT_ID=project_id');
        putenv('APP_ENV=app_env');

        $this->testDir = dirname(dirname(dirname(__FILE__)));
        $this->monologFactory = new MonologFactory($this->testDir . '/configs/monolog.configs.json');
    }

    /**
     * @covers \Micronative\ObjectFactory\Log\Monolog\MonologFactory::create
     * @throws \Micronative\ObjectFactory\Log\Monolog\Exceptions\MonologConfigException
     */
    public function testCreate()
    {
        $monolog = $this->monologFactory->create('monolog.ms.crm');
        $this->assertTrue($monolog instanceof Logger);
    }
}

