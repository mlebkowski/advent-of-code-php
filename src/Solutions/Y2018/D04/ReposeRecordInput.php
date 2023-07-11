<?php

declare(strict_types=1);

namespace App\Solutions\Y2018\D04;

use App\Solutions\Y2018\D04\Event\EventLog;

final readonly class ReposeRecordInput
{
    public function __construct(public EventLog $eventLog)
    {
    }
}
