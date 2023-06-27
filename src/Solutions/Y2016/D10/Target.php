<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D10;

use Stringable;

final readonly class Target implements Stringable
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

    private function __construct(private TargetType $type, public int $value)
    {
    }

    public function isOutput(): bool
    {
        return $this->type === TargetType::Output;
    }

    public function __toString(): string
    {
        return sprintf('%s %d', $this->type->value, $this->value);
    }
}
