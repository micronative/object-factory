<?php

namespace Micronative\Aws\Sqs\Exceptions;

use Micronative\Exceptions\BaseException;

class SqsConfigException extends BaseException
{

    public const DOMAIN = 'Micronative\Aws\Sqs';
    public const INVALID_CONFIG_FILE = 'Invalid config file: ';
    public const INVALID_CONNECTION_NAME = 'Unknown connection name: ';

}
