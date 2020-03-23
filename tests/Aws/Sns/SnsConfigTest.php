<?php
namespace Micronative\Test\Aws\Sns;

use Micronative\Aws\Sns\SnsClientFactory;
use Micronative\Aws\Sns\SnsClient;
use PHPUnit\Framework\TestCase;


class SnsConfigTest extends TestCase
{
    private $testDir;
    private $connectionName;

    /** @var $snsClientFactory SnsClientFactory*/
    private $snsClientFactory;

    /** @var $snsClient SnsClient*/
    private $snsClient;

    /** @var $config \Micronative\Aws\Sns\SnsConfig*/
    private $config;

    public function setUp()
    {
        parent::setUp();

        $this->connectionName = 'sns.ms.crm';
        $this->testDir = dirname(dirname(__FILE__));
        $this->snsConfigFilename = '/../../configs/sns.configs.json';
        $this->snsConfigSettings = $this->testDir . $this->snsConfigFilename;
        $this->configContents =  json_decode(file_get_contents($this->snsConfigSettings), true);
        $this->configContents = $this->configContents[$this->connectionName];
        $this->snsClientFactory = new SnsClientFactory($this->snsConfigSettings);
        $this->snsClient = $this->snsClientFactory->create($this->connectionName);
        $this->config = $this->snsClient->getConfig();
    }

    public function testConfig()
    {
        $result = $this->config->getRegion();
        $this->config->setRegion($result);
        $this->assertSame($this->config->getRegion(), $this->configContents['region']);

        $result = $this->config->getKey();
        $this->config->setKey($result);
        $this->assertSame($this->config->getKey(), $this->configContents['key']);

        $result = $this->config->getSecret();
        $this->config->setSecret($result);
        $this->assertSame($this->config->getSecret(), $this->configContents['secret']);

        $result = $this->config->getConnectionName();
        $this->config->setConnectionName($result);
        $this->assertSame($this->config->getConnectionName(), $this->connectionName);
    }
}