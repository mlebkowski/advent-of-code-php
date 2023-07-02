<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D21\Operations;

final readonly class MovePosition implements Operation
{
    public static function of(int $from, int $to): self
    {
        return new self($from, $to);
    }

    private function __construct(private int $from, private int $to)
    {
        assert($this->from >= 0 && $this->to >= 0);
    }

    public function scramble(string $input): string
    {
        assert($this->to < strlen($input) && $this->from < strlen($input));

        $length = abs($this->to - $this->from) + 1;
        $start = min($this->from, $this->to);
        $op = $this->from > $this->to ? RotateRight::of(1) : RotateLeft::of(1);
        return substr_replace(
            $input,
            $op->scramble(substr($input, $start, $length)),
            offset: $start,
            length: $length,
        );
    }

    public function reverse(string $input): string
    {
        return self::of($this->to, $this->from)->scramble($input);
    }

    public function __toString(): string
    {
        return "move position $this->from to position $this->to";
    }
}
