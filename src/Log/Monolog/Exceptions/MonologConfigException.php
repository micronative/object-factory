<?php

namespace Micronative\ObjectFactory\Log\Monolog\Exceptions;

use Micronative\ObjectFactory\Exceptions\BaseException;

class MonologConfigException extends BaseException
{
    
    public const DOMAIN                  = 'Micronative\ObjectFactory\Log\Monolog';
    public const INVALID_CONFIG_FILE     = 'Invalid config file: ';
    public const INVALID_CONNECTION_NAME = 'Unknown connection name: ';
    
}
