<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D18;

use App\Aoc\Progress\Progress;
use loophp\collection\Collection;
use Stringable;

final readonly class Room implements Stringable
{
    public static function populateFromFirstRow(Row $row, int $count): self
    {
        assert($count > 1);

        $rows = [$row];
        while (count($rows) < $count) {
            $rows[] = $row = $row->next();
        }

        return new self($rows);
    }

    public static function calculateSafeTilesCount(Row $firstRow, int $count, Progress $progress): int
    {
        assert($count > 1);

        $row = $firstRow;
        $i = 1;
        $sum = 0;

        while ($i <= $count) {
            $progress->step();
            $sum += $row->safeTileCount();
            $progress->report($row);

            $row = $row->next();
            $i++;
        }

        return $sum;
    }

    private function __construct(private array $rows)
    {
    }

    public function safeTileCount(): int
    {
        return Collection::fromIterable($this->rows)
            ->reduce(static fn (int $sum, Row $row) => $sum + $row->safeTileCount(), 0);
    }

    public function __toString(): string
    {
        return Collection::fromIterable($this->rows)->implode("\n");
    }
}
