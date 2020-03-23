<?php

declare(strict_types = 1);

namespace Micronative\Aws\Sqs;

use Micronative\Sqs\SqsMessage;

interface SqsClientInterface
{

    /**
     * @param string $body
     * @param string $groupId
     * @param array|null $properties
     * @return mixed
     */
    public function publish(string $body, string $groupId, array $properties = []);

    /**
     * @return \Micronative\Sqs\SqsMessage|mixed
     */
    public function receive();

    /**
     * @param \Micronative\Sqs\SqsMessage|null $message
     * @return mixed
     */
    public function acknowledge(SqsMessage $message = null);

    /**
     * @param \Micronative\Sqs\SqsMessage|null $message
     * @param bool $requeue
     * @return mixed
     */
    public function reject(SqsMessage $message = null, bool $requeue = false);

}
