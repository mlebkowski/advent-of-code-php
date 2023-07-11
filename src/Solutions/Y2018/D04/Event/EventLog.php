<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D04\Event;

use IteratorAggregate;
use loophp\collection\Collection;
use Traversable;

final readonly class EventLog implements IteratorAggregate
{
    public static function of(Event ...$events): self
    {
        $events = Collection::fromIterable($events)
            ->sort(
                callback: static fn (Event $alpha, Event $bravo) => $alpha->timestamp() <=> $bravo->timestamp(),
            )
            ->all();
        return new self($events);
    }

    private function __construct(/** @var Event[] */ public array $events)
    {
    }

    public function getIterator(): Traversable
    {
        return Collection::fromIterable($this->events);
    }
}
