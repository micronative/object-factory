<?php

declare(strict_types=1);

namespace Micronative\ObjectFactory\Aws\Sns;

interface SnsClientInterface
{
    
    /**
     * @param string $topic
     * @param string $body
     * @param array|null $properties
     * @return mixed
     */
    public function send(string $topic, string $body, array $properties = []);
    
}
