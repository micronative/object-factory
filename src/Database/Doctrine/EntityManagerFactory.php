<?php

namespace Micronative\ObjectFactory\Database\Doctrine;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Cache\FilesystemCache;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\ORM\Tools\Setup;

class EntityManagerFactory
{

    /** @var string */
    protected $configFile;

    /** @var \Micronative\ObjectFactory\Database\Doctrine\DoctrineConfigFactory */
    protected $configFactory;

    /**
     * EntityManagerFactory constructor.
     *
     * @param string|null $configFile
     * @throws \Micronative\ObjectFactory\Database\Doctrine\Exceptions\DoctrineConfigException
     * @throws \Micronative\ServiceSchema\Json\Exception\JsonException
     */
    public function __construct(?string $configFile = null)
    {
        $this->configFile = $configFile;
        $this->configFactory = new DoctrineConfigFactory($configFile);
    }

    /**
     * @param string|null $connectionName
     * @return \Doctrine\ORM\EntityManager
     * @throws \Micronative\ObjectFactory\Database\Doctrine\Exceptions\DoctrineConfigException
     * @throws \Doctrine\Common\Annotations\AnnotationException
     * @throws \Doctrine\ORM\ORMException
     */
    public function create(?string $connectionName = null): EntityManager
    {
        $config = $this->configFactory->get($connectionName);
        $connection = $config->getConnection();
        $configuration = Setup::createAnnotationMetadataConfiguration($config->getMetadataDirs(), $config->isDevMode());
        $reader = new AnnotationReader;

        if ($config->getIgnoredNamespaces()) {
            foreach ($config->getIgnoredNamespaces() as $namespace)
                $reader->addGlobalIgnoredNamespace($namespace);
        }

        $configuration->setMetadataDriverImpl(
            new AnnotationDriver($reader, $config->getMetadataDirs())
        );

        if ($config->getCacheDir()) {
            $configuration->setMetadataCacheImpl(
                new FilesystemCache($config->getCacheDir())
            );
        }

        return EntityManager::create($connection, $configuration);
    }

    /**
     * @return string
     */
    public function getConfigFile(): string
    {
        return $this->configFile;
    }

    /**
     * @param string $configFile
     * @return \Micronative\ObjectFactory\Database\Doctrine\EntityManagerFactory
     */
    public function setConfigFile(string $configFile): EntityManagerFactory
    {
        $this->configFile = $configFile;

        return $this;
    }

    /**
     * @return \Micronative\ObjectFactory\Database\Doctrine\DoctrineConfigFactory
     */
    public function getConfigFactory(): DoctrineConfigFactory
    {
        return $this->configFactory;
    }

    /**
     * @param \Micronative\ObjectFactory\Database\Doctrine\DoctrineConfigFactory $configFactory
     * @return \Micronative\ObjectFactory\Database\Doctrine\EntityManagerFactory
     */
    public function setConfigFactory(DoctrineConfigFactory $configFactory): EntityManagerFactory
    {
        $this->configFactory = $configFactory;

        return $this;
    }

}
