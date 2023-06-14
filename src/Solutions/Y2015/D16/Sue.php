<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D16;

use loophp\collection\Collection;
use Stringable;

final readonly class Sue implements Stringable
{
    private array $attributes;

    public static function of(string $name, array $attributePairs): self
    {
        $attributeValues = Collection::fromIterable($attributePairs)
            ->pair()
            ->map(
                static fn (string $value, string $key) => new AttributeValue(
                    Attribute::from($key),
                    (int)$value,
                ),
            );

        return new self($name, ...$attributeValues);
    }

    private function __construct(public string $name, AttributeValue ...$attributes)
    {
        $types = Collection::fromIterable($attributes)
            ->map(static fn (AttributeValue $attributeValue) => $attributeValue->attribute->name)
            ->distinct();
        assert(count($types) === count($attributes), 'Oops, I can’t handle non-unique attribute value');

        $this->attributes = $attributes;
    }

    public function matches(AttributeValue $attributeValue, bool $outdatedRetroEncabulator): bool
    {
        return $attributeValue->tryEquals(
            $this->getAttributeValue($attributeValue->attribute),
            $outdatedRetroEncabulator,
        );
    }

    private function getAttributeValue(Attribute $attribute): AttributeValue|null
    {
        return Collection::fromIterable($this->attributes)
            ->find(
                null,
                static fn (AttributeValue $attr) => $attribute === $attr->attribute,
            );
    }

    public function __toString()
    {
        return "Sue {$this->name}";
    }
}
