<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D13\Visualizer;

use loophp\collection\Collection;

final readonly class UnmonitoredLayer implements ColumnPrinter
{
    public static function of(int $height): self
    {
        return new self($height);
    }

    private function __construct(private int $height)
    {
    }

    public function column(int $picosecond, bool $hasPacket, Move $move): array
    {
        return Collection::fromIterable(range(0, $this->height))
            ->map(static fn (int $rowNo) => match (true) {
                $rowNo === 0 => match ($hasPacket) {
                    true => '(.)',
                    false => '...',
                },
                default => str_repeat(' ', 3),
            })
            ->all();
    }
}
