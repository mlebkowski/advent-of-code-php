<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D21\Operations;

final readonly class ReverseRange implements Operation
{
    public static function of(int $start, int $end): self
    {
        return new self($start, $end);
    }

    private function __construct(private int $start, private int $end)
    {
        assert($this->start >= 0 && $this->end >= 0);
        assert($this->start <= $this->end);
    }

    public function scramble(string $input): string
    {
        assert($this->end < strlen($input));
        $length = $this->end - $this->start + 1;

        return substr_replace(
            string: $input,
            replace: strrev(substr($input, $this->start, $length)),
            offset: $this->start,
            length: $length,
        );
    }

    public function reverse(string $input): string
    {
        return $this->scramble($input);
    }

    public function __toString(): string
    {
        return "reverse positions $this->start through $this->end";
    }
}
