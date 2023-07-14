<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D17;

use App\Lib\Type\Cast;
use App\Realms\Cartography\Map;
use App\Realms\Cartography\Orientation;
use App\Realms\Cartography\Point;
use Generator;
use loophp\collection\Collection;

final class Stream
{
    private WaterPool $filled;
    private WaterPool $flowing;
    /** @var Point[] */
    private array $streams = [];

    /**
     * The Generics order is wrong, but PHPStorm complains
     * @return Generator<null,int,Water,Point>
     */
    public static function of(Map $map, Point $start): Generator
    {
        $clayDeposits = ClayDeposits::ofMap($map);
        $height = $map->height;
        $stream = new self($clayDeposits, $height);
        return $stream->flow($start);
    }

    private function __construct(private readonly ClayDeposits $deposits, private readonly int $height)
    {
        $this->filled = WaterPool::empty('~');
        $this->flowing = WaterPool::empty(' ');
    }

    /** @return Generator<null,int,Point,Water> */
    private function flow(Point $start): Generator
    {
        yield $start;
        $this->streams = [$start];

        while ($head = array_shift($this->streams)) {
            yield from match (true) {
                $this->peekDirection($head, Orientation::South) => $this->flowDown($head),
                default => $this->fillUp($head),
            };
            $this->cleanupStreams();
            usort($this->streams, Point::sortForGrid(...));
        }
        return Water::of(
            $this->filled->count(),
            $this->filled->merge($this->flowing)->count(),
        );
    }

    /** @return Generator<null,int,Point,Point> */
    private function flowDown(Point $point): Generator
    {
        $flow = $this->untilBlocked($point, Orientation::South);
        foreach ($flow as $step) {
            if ($step->y >= $this->height) {
                return;
            }

            yield from $this->flowing->add($step);
        }

        $next = $flow->getReturn();
        // if we *land* on a dried up spot that has not been filled
        // never go into the same river twice or something?
        if ($this->inFlowingWater($next)) {
            return;
        }
        $this->streams[] = $next;
    }

    /** @return Generator<null,int,Point> */
    private function fillUp(Point $point): Generator
    {
        if (false === $this->flowing->contains($point)) {
            yield from $this->flowing->add($point);
        }

        $toLeft = $this->untilBlockedOrFalls($point, Orientation::West);
        $toRight = $this->untilBlockedOrFalls($point, Orientation::East);
        $leftFlow = iterator_to_array($toLeft);
        $rightFlow = iterator_to_array($toRight);

        $left = $toLeft->getReturn();
        $right = $toRight->getReturn();
        $leftExits = $this->peekDirection($left, Orientation::South);
        $rightExits = $this->peekDirection($right, Orientation::South);

        if (false === ($leftExits || $rightExits)) {
            if (false === $this->filled->contains($point)) {
                yield from $this->filled->add($point);
            }

            yield from $this->filled->add(...$leftFlow, ...$rightFlow);
            $this->streams[] = $point->inDirection(Orientation::North);
            return;
        }

        if ($leftExits) {
            yield from $this->flowing->add(...$rightFlow, ...$leftFlow);
            $this->streams[] = $left;
            if ($rightExits) {
                $this->streams[] = $right;
            }
            return;
        }

        $this->streams[] = $right;
        yield from $this->flowing->add(...$leftFlow, ...$rightFlow);
    }

    /** @return Generator<null,int,Point,Point> */
    private function untilBlockedOrFalls(Point $from, Orientation $direction): Generator
    {
        $flow = $this->untilBlocked($from, $direction);

        foreach ($flow as $point) {
            yield $point;
            if ($this->peekDirection($point, Orientation::South)) {
                return $point;
            }
        }

        return $flow->getReturn();
    }

    /** @return Generator<null,int,Point,Point> */
    private function untilBlocked(Point $point, Orientation $orientation): Generator
    {
        while ($this->peekDirection($point, $orientation)) {
            $point = $point->inDirection($orientation);
            yield $point;
        }

        return $point;
    }

    private function peekDirection(Point $point, Orientation $orientation): bool
    {
        $next = $point->inDirection($orientation);

        if ($this->deposits->blocksWater($next)) {
            return false;
        }

        if ($orientation->isHorizontal()) {
            return true;
        }

        return false === $this->filled->contains($next);
    }

    private function cleanupStreams(): void
    {
        if (count($this->streams) < 2) {
            return;
        }
        $this->streams = Collection::fromIterable($this->streams)
            ->distinct(accessorCallback: $this->leftMostBlocked(...))
            ->all();
    }

    private function inFlowingWater(mixed $next): bool
    {
        return $this->flowing->contains($next->inDirection(Orientation::West))
            || $this->flowing->contains($next->inDirection(Orientation::East));
    }

    private function leftMostBlocked(Point $point): string
    {
        return Collection::fromGenerator($this->untilBlockedOrFalls($point, Orientation::West))
            ->map(Cast::toString(...))
            ->last((string)$point);
    }
}
