<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D21\Operations;

use App\Solutions\Y2016\D21\Operations\Problems\CannotReverseRotation;

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

    public function scramble(string $input): string
    {
        $pos = strpos($input, $this->letter);
        $target = 1 + $pos + ($pos >= strlen($input) / 2 ? 1 : 0);
        return RotateRight::of($target)->scramble($input);
    }

    public function reverse(string $input): string
    {
        $len = strlen($input);
        CannotReverseRotation::whenLengthIsOdd($len);

        $pos = strpos($input, $this->letter);
        // `$pos ?: $len` is a special case to convert 0 to max index
        // `($pos+1) % 2) * $len`: all even indexes are raised
        $target = (int)floor((($pos ?: $len) - 1 + (($pos + 1) % 2) * $len) / 2);
        $steps = $len + $pos - $target;
        return RotateRight::of($steps)->reverse($input);
    }

    public function __toString(): string
    {
        return "rotate based on position of letter $this->letter";
    }
}
