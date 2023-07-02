<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D21\Operations;

final readonly class RotateBasedOnLetter implements Operation
{
    public static function of(string $letter): self
    {
        return new self($letter);
    }

    private function __construct(private string $letter)
    {
        assert(strlen($this->letter) === 1);
    }

    public function apply(string $input): string
    {
        $pos = strpos($input, $this->letter);
        return RotateRight::of(1 + $pos + ($pos >= 4 ? 1 : 0))->apply($input);
    }

    public function __toString(): string
    {
        return "rotate based on position of letter $this->letter";
    }
}
