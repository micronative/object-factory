<?php

namespace Micronative\ObjectFactory\Test\Database\Doctrine;

use Micronative\ObjectFactory\Database\Doctrine\DoctrineConfig;
use Micronative\ObjectFactory\Database\Doctrine\DoctrineConfigFactory;
use PHPUnit\Framework\TestCase;

class DoctrineConfigFactoryTest extends TestCase
{
    private $testDir;
    private $configContents;
    private $connectionName;
    
    /** @var $doctrineConfigFactory doctrineConfigFactory */
    private $doctrineConfigFactory;
    
    public function setUp()
    {
        parent::setUp();
        $this->connectionName        = 'doctrine.ms.crm';
        $this->testDir               = dirname(dirname(dirname(__FILE__)));
        $this->sqsConfigFilename     = '/configs/doctrine.configs.json';
        $this->sqsConfigSettings     = $this->testDir . $this->sqsConfigFilename;
        $this->configContents        = json_decode(file_get_contents($this->sqsConfigSettings), true);
        $this->configContents        = $this->configContents[$this->connectionName];
        $this->doctrineConfigFactory = new DoctrineConfigFactory($this->sqsConfigSettings);
    }
    
    public function testConfig()
    {
        $result = $this->doctrineConfigFactory->get(DoctrineConfigFactory::DOCTRINE_CONNECTION_CRM);
        $this->assertSame($result->getConnectionName(), DoctrineConfigFactory::DOCTRINE_CONNECTION_CRM);
    }
}