<?php

namespace Micronative\ObjectFactory\Cache\Redis\Exceptions;

use Micronative\ObjectFactory\Exceptions\BaseException;

class RedisConfigException extends BaseException
{

    public const DOMAIN = 'Micronative\ObjectFactory\Cache\Redis';
    public const INVALID_CONFIG_FILE = 'Invalid config file: ';
    public const INVALID_CONNECTION_NAME = 'Unknown connection name: ';

}
