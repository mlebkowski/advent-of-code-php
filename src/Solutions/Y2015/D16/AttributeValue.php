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

    public function tryEquals(?AttributeValue $other): bool
    {
        if (null === $other) {
            return true;
        }

        return $other->attribute === $this->attribute && $other->value === $this->value;
    }
}
