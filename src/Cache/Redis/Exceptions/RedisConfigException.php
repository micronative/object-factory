<?php

namespace Micronative\Cache\Redis\Exceptions;

use Micronative\Exceptions\BaseException;

class RedisConfigException extends BaseException
{

    public const DOMAIN = 'Micronative\Cache\Redis';
    public const INVALID_CONFIG_FILE = 'Invalid config file: ';
    public const INVALID_CONNECTION_NAME = 'Unknown connection name: ';

}
