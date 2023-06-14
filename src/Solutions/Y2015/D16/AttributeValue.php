<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D16;

final readonly class AttributeValue
{
    public static function empty(Attribute $attribute): self
    {
        return new self($attribute, null);
    }

    public function __construct(public Attribute $attribute, public int|null $value)
    {
    }

    public function tryEquals(?AttributeValue $other, bool $outdatedRetroEncabulator): bool
    {
        if (null === $other) {
            return true;
        }

        if ($other->attribute !== $this->attribute) {
            return false;
        }

        if (false === $outdatedRetroEncabulator) {
            return $other->value === $this->value;
        }

        return match (true) {
            $this->attribute->isFewerThan() => $this->value > $other->value,
            $this->attribute->isGreaterThan() => $this->value < $other->value,
            default => $this->value === $other->value,
        };
    }
}
