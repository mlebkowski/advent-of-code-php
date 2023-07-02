<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D21\Operations;

final readonly class SwapLetters implements Operation
{
    public static function of(string $alpha, string $bravo): self
    {
        return new self($alpha, $bravo);
    }

    private function __construct(private string $alpha, private string $bravo)
    {
        assert(strlen($this->alpha) === 1 && strlen($this->bravo) === 1);
        assert($this->alpha !== $this->bravo);
    }

    public function apply(string $input): string
    {
        assert(str_contains($input, $this->alpha));
        assert(str_contains($input, $this->bravo));

        return SwapPositions::of(
            alpha: strpos($input, $this->alpha),
            bravo: strpos($input, $this->bravo),
        )->apply($input);
    }

    public function __toString(): string
    {
        return "swap letter $this->alpha with letter $this->bravo";
    }
}
