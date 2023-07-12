<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D11;

final readonly class SummedAreaTable
{
    public static function of(array $grid): self
    {
        $sums = [];
        foreach ($grid as $y => $row) {
            $current = 0;
            foreach ($row as $x => $value) {
                $current += $value;
                $sums[$y][$x] = $current + ($sums[$y - 1][$x] ?? 0);
            }
        }
        return new self($sums);
    }

    private function __construct(public array $sums)
    {
    }

    public function sum(int $x, int $y, int $w, int $h): int
    {
        return $this->at($x - 1, $y - 1) + $this->at($x + $w - 1, $y + $h - 1)
            - $this->at($x - 1, $y + $h - 1) - $this->at($x + $w - 1, $y - 1);
    }

    private function at(int $x, int $y): int
    {
        return $this->sums[$y][$x] ?? 0;
    }
}
