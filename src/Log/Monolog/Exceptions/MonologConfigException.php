<?php

namespace Micronative\Log\Monolog\Exceptions;

use Micronative\Exceptions\BaseException;

class MonologConfigException extends BaseException
{

    public const DOMAIN = 'Micronative\Log\Monolog';
    public const INVALID_CONFIG_FILE = 'Invalid config file: ';
    public const INVALID_CONNECTION_NAME = 'Unknown connection name: ';

}
