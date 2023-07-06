<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D12;

use loophp\collection\Collection;

final readonly class PlumbingSystem
{
    public static function ofPipes(Pipe ...$pipe): self
    {
        return self::ofConnections(
            Collection::fromIterable($pipe)
                ->map(static fn (Pipe $pipe) => [$pipe->alpha, $pipe->bravo])
                ->unpack()
                ->groupBy(static fn (int $target, int $source) => $source)
                ->all(false),
        );
    }

    public static function ofConnections(array $connections): self
    {
        return new self($connections);
    }

    private function __construct(private array $connections)
    {
    }

    public function connectedTo(int $pipeId): int
    {
        return count($this->expandGroup($pipeId));
    }

    public function numberOfGroups(): int
    {
        $head = key($this->connections);
        if (null === $head) {
            return 0;
        }

        $group = $this->expandGroup($head);
        $rest = Collection::fromIterable($this->connections)
            ->reject(static fn ($values, int $source) => in_array($source, $group, true))
            ->all(false);

        return 1 + self::ofConnections($rest)->numberOfGroups();
    }

    private function expandGroup(int $pipeId): array
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

        return $seen;
    }
}
