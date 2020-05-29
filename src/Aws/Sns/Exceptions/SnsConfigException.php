<?php

namespace Micronative\ObjectFactory\Aws\Sns\Exceptions;

use Micronative\ObjectFactory\Exceptions\BaseException;

class SnsConfigException extends BaseException
{
    
    public const DOMAIN                  = 'Micronative\ObjectFactory\Aws\Sns';
    public const INVALID_CONFIG_FILE     = 'Invalid config file: ';
    public const INVALID_CONNECTION_NAME = 'Unknown connection name: ';
    
}
