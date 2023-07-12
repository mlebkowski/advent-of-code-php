<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D12;

final readonly class Rule
{
    public static function of(Pot $result, Pot ...$neighbours): self
    {
        return new self($result, $neighbours);
    }

    private function __construct(public Pot $result, public array $neighbours)
    {
        assert(count($this->neighbours) === 5);
    }

    public function matches(Pot ...$neighbours): bool
    {
        return $neighbours === $this->neighbours;
    }
}
