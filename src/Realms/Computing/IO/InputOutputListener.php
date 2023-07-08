<?php
declare(strict_types=1);

namespace App\Realms\Computing\IO;

use App\Realms\Computing\Processor\Processor;
use Generator;

final class InputOutputListener
{
    public static function of(Processor $processor, Device $device): Generator
    {
        $processor->attachIODevice($device);
        $thread = $processor->start();
        while ($thread->valid()) {
            $thread->send(null);
            yield from $device->consumeOutputBuffer();
        }
    }
}
