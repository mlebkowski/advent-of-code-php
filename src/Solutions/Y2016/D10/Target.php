<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D10;

final readonly class Target
{
    public static function fromString(string $target): self
    {
        [$type, $value] = explode(' ', $target);
        return self::of(TargetType::from($type), (int)$value);
    }

    public static function of(TargetType $type, int $value): self
    {
        return new self($type, $value);
    }

    private function __construct(public TargetType $type, public int $value)
    {
    }
}
