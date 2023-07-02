<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D21;

use App\Solutions\Y2016\D21\Operations\Operation;

final class Scrambler
{
    public static function of(Operation ...$operations): self
    {
        return new self($operations);
    }

    private function __construct(private readonly array $operations)
    {
    }

    public function scramble(string $input): string
    {
        return array_reduce(
            $this->operations,
            static fn (string $value, Operation $operation) => $operation->scramble($value),
            $input,
        );
    }

    public function reverse(string $input): string
    {
        return array_reduce(
            array_reverse($this->operations),
            static fn (string $value, Operation $operation) => $operation->reverse($value),
            $input,
        );
    }
}
