<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D21\Operations;

final readonly class SwapPositions implements Operation
{
    public static function of(int $alpha, int $bravo): self
    {
        return new self($alpha, $bravo);
    }

    private function __construct(private int $alpha, private int $bravo)
    {
        assert($alpha >= 0 && $bravo >= 0);
    }

    public function apply(string $input): string
    {
        assert($this->alpha < strlen($input) && $this->bravo < strlen($input));
        $alpha = $input[$this->alpha];
        $bravo = $input[$this->bravo];
        $input[$this->alpha] = $bravo;
        $input[$this->bravo] = $alpha;
        return $input;
    }

    public function __toString(): string
    {
        return "swap position $this->alpha with position $this->bravo";
    }
}
