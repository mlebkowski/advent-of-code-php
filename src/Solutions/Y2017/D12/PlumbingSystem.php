<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D12;

use loophp\collection\Collection;

final readonly class PlumbingSystem
{
    public static function ofPipes(Pipe ...$pipe): self
    {
        return new self(
            Collection::fromIterable($pipe)
                ->flatMap(static fn (Pipe $pipe) => [[$pipe->alpha, $pipe->bravo], [$pipe->bravo, $pipe->alpha]])
                ->unpack()
                ->groupBy(static fn (int $target, int $source) => $source)
                ->all(false),
        );
    }

    private function __construct(private array $connections)
    {
    }

    public function connectedTo(int $pipeId): int
    {
        $seen = [$pipeId];
        $toExplore = $this->connections[$pipeId];
        while (count($toExplore)) {
            $seen = array_unique([...$seen, ...$toExplore]);
            $connections = Collection::fromIterable($this->connections)
                ->filter(static fn ($values, int $source) => in_array($source, $toExplore, true))
                ->flatten()
                ->distinct()
                ->all();
            $toExplore = array_diff($connections, $seen);
        }

        return count($seen);
    }

}
