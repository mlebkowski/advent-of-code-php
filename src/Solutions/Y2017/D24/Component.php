<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D24;

use Stringable;

final readonly class Component implements Stringable
{
    public static function of(int $out, int $in): self
    {
        return new self($out, $in);
    }

    private function __construct(public int $out, public int $in)
    {
    }

    public function flip(): self
    {
        return self::of($this->in, $this->out);
    }

    public function strength(): int
    {
        return $this->in + $this->out;
    }

    public function __toString(): string
    {
        return "$this->out/$this->in";
    }
}
