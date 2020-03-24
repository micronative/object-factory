<?php

namespace Brighte\Tests\Infrastructure\Log\Monolog;

use Micronative\ObjectFactory\Log\Monolog\MonologConfigFactory;
use PHPUnit\Framework\TestCase;

class MonologConfigFactoryTest extends TestCase
{

    /** @var string */
    protected $testDir;

    /** @var \Micronative\ObjectFactory\Log\Monolog\MonologConfigFactory */
    protected $configFactory;

    /**
     * @throws \Micronative\ObjectFactory\Log\Monolog\Exceptions\MonologConfigException
     * @throws \Micronative\ServiceSchema\Json\Exception\JsonException
     */
    public function setUp()
    {
        parent::setUp();
        putenv('APP_NAME=name');
        putenv('APP_LOG_PATH=path');
        putenv('APP_LOG_LEVEL=100');
        putenv('APP_LOG_SENTRY=true');
        putenv('SENTRY_DSN=dsn');
        putenv('SENTRY_PUBLIC_KEY=public_key');
        putenv('SENTRY_HOST=host');
        putenv('SENTRY_PROJECT_ID=project_id');
        putenv('APP_ENV=app_env');

        $this->testDir = dirname(dirname(dirname(__FILE__)));
        $this->configFactory = new MonologConfigFactory($this->testDir . '/configs/monolog.configs.json');
    }

    /**
     * @covers \Micronative\ObjectFactory\Log\Monolog\MonologConfigFactory::loadConfigs
     * @covers \Micronative\ObjectFactory\Log\Monolog\MonologConfigFactory::get
     */
    public function testConfig()
    {
        /** @var \Micronative\ObjectFactory\Log\Monolog\MonologConfig $config */
        $config = $this->configFactory->get('monolog.ms.crm');
        $this->assertEquals($config->getConfigName(), 'monolog.ms.crm');
        $this->assertEquals($config->getName(), getenv('APP_NAME'));
        $this->assertEquals($config->getPath(), getenv('APP_LOG_PATH'));
        $this->assertEquals($config->getLevel(), '100');
        $this->assertEquals($config->getSentryDsn(), getenv('SENTRY_DSN'));
        $this->assertEquals($config->getSentryPublicKey(), getenv('SENTRY_PUBLIC_KEY'));
        $this->assertEquals($config->getSentryHost(), getenv('SENTRY_HOST'));
        $this->assertEquals($config->getSentryProjectId(), getenv('SENTRY_PROJECT_ID'));
        $this->assertEquals($config->getSentryEnvironment(), getenv('APP_ENV'));
    }
}

