<?php

namespace Micronative\Aws\Sns\Exceptions;

use Micronative\Exceptions\BaseException;

class SnsConfigException extends BaseException
{

    public const DOMAIN = 'Micronative\Aws\Sns';
    public const INVALID_CONFIG_FILE = 'Invalid config file: ';
    public const INVALID_CONNECTION_NAME = 'Unknown connection name: ';

}
