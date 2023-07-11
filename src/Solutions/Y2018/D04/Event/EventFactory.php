<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D04\Event;

use DateTimeImmutable;

final class EventFactory
{
    public static function factory(string $date, string $hour, string $event): Event
    {
        $date = new DateTimeImmutable("$date $hour");
        return match (true) {
            str_starts_with($event, 'falls asleep') => FallsAsleep::of($date),
            str_starts_with($event, 'wakes up') => WakesUp::of($date),
            str_starts_with($event, 'Guard') => ShiftBegins::of($date, ...sscanf($event, 'Guard #%d')),
        };
    }
}
