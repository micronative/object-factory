<?php

namespace Micronative\Database\Doctrine\Exceptions;

use Micronative\Exceptions\BaseException;

class DoctrineConfigException extends BaseException
{

    public const DOMAIN = 'Micronative\Database\Doctrine';
    public const INVALID_CONFIG_FILE = 'Invalid config file: ';
    public const INVALID_CONNECTION_NAME = 'Unknown connection name: ';

}
