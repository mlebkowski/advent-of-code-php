<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D04;

use App\Solutions\Y2018\D04\Event\Event;
use App\Solutions\Y2018\D04\Event\FallsAsleep;
use App\Solutions\Y2018\D04\Event\ShiftBegins;
use App\Solutions\Y2018\D04\Event\WakesUp;
use RuntimeException;

final class NightBuilder
{
    public static function fromEvents(Event ...$events): Year
    {
        $guardId = null;
        $shiftStart = null;
        $sleepStart = null;
        $sleepPeriods = [];
        $nights = [];

        foreach ($events as $event) {
            switch (true) {
                case $event instanceof ShiftBegins:
                    assert(null === $sleepStart);
                    if ($guardId) {
                        $nights[] = Night::of($guardId, $shiftStart, ...$sleepPeriods);
                    }
                    $guardId = $event->guardId;
                    $shiftStart = $event->timestamp();
                    $sleepStart = null;
                    $sleepPeriods = [];
                    break;
                case $event instanceof FallsAsleep:
                    assert(null === $sleepStart && null !== $guardId);
                    $sleepStart = $event->timestamp();
                    break;
                case $event instanceof WakesUp:
                    assert(null !== $sleepStart && null !== $guardId);
                    $sleepPeriods[] = Sleep::of($sleepStart, $event->timestamp());
                    $sleepStart = null;
                    break;
                default:
                    throw new RuntimeException("Unknown event: " . $event::class);
            }
        }

        assert(null === $sleepStart && null !== $guardId && null !== $shiftStart);
        $nights[] = Night::of($guardId, $shiftStart, ...$sleepPeriods);
        return Year::of(...$nights);
    }
}
