<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D08\LittleScreen;

final readonly class Line
{
    public static function of(Pixel ...$pixels): self
    {
        return new self($pixels);
    }

    private function __construct(public array $pixels)
    {
    }

    public function rotate(int $offset): self
    {
        assert($offset > 0);
        $offset = $offset % count($this->pixels);
        $pixels = [
            ...array_slice($this->pixels, -$offset),
            ...array_slice($this->pixels, 0, -$offset),
        ];

        return new self($pixels);
    }
}
