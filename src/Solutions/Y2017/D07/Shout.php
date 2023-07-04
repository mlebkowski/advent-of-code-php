<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D07;

use Stringable;

final readonly class Shout implements Stringable
{
    public static function of(Program $program, string ...$above): self
    {
        return new self($program, $above);
    }

    private function __construct(public Program $program, public array $above)
    {
    }

    public function isTopmost(): bool
    {
        return 0 === count($this->above);
    }

    public function __toString(): string
    {
        if ($this->isTopmost()) {
            return "$this->program";
        }
        $above = implode(', ', $this->above);
        return "$this->program -> $above";
    }
}
