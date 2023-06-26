<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D08\Operation;

use Stringable;

final readonly class Rect implements Stringable
{
    public static function of(int $width, int $height): self
    {
        return new self($width, $height);
    }

    private function __construct(public int $width, public int $height)
    {
    }

    public function __toString(): string
    {
        return sprintf('rect %d×%d', $this->width, $this->height);
    }

}
