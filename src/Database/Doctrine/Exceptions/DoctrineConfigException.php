<?php

namespace Micronative\ObjectFactory\Database\Doctrine\Exceptions;

use Micronative\ObjectFactory\Exceptions\BaseException;

class DoctrineConfigException extends BaseException
{
    
    public const DOMAIN                  = 'Micronative\ObjectFactory\Database\Doctrine';
    public const INVALID_CONFIG_FILE     = 'Invalid config file: ';
    public const INVALID_CONNECTION_NAME = 'Unknown connection name: ';
    
}
