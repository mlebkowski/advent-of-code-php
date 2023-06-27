<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D13;

final readonly class CoordinateBuilder
{
    public static function of(int $magicNumber, int $width): self
    {
        return new self($magicNumber, $width);
    }

    private function __construct(private int $magicNumber, private int $width)
    {
    }

    public function fromIndex(float $idx): bool
    {
        $x = $idx % $this->width;
        $y = floor($idx / $this->width);
        $value = $x * $x + 3 * $x + 2 * $x * $y + $y + $y * $y + $this->magicNumber;
        return substr_count(decbin((int)$value), '1') % 2 === 1;
    }
}
