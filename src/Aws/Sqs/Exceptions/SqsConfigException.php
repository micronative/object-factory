<?php

namespace Micronative\ObjectFactory\Aws\Sqs\Exceptions;

use Micronative\ObjectFactory\Exceptions\BaseException;

class SqsConfigException extends BaseException
{
    
    public const DOMAIN                  = 'Micronative\ObjectFactory\Aws\Sqs';
    public const INVALID_CONFIG_FILE     = 'Invalid config file: ';
    public const INVALID_CONNECTION_NAME = 'Unknown connection name: ';
    
}
