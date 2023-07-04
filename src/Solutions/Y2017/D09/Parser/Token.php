<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D09\Parser;

final readonly class Token
{
    public static function of(Type $type, string $value): self
    {
        return new self($type, $value);
    }

    private function __construct(public Type $type, public string $value)
    {
    }
}
