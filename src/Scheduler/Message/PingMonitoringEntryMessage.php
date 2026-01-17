<?php

namespace App\Scheduler\Message;

use Symfony\Component\Messenger\Attribute\AsMessage;

#[AsMessage('async')]
readonly class PingMonitoringEntryMessage
{
    public function __construct(
        private int $monitoringConfigId,
    )
    {
    }

    public function getMonitoringConfigId(): int
    {
        return $this->monitoringConfigId;
    }
}
