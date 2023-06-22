<?php

declare(strict_types=1);

namespace App\Realms\RolePlaying\Magic;

use App\Realms\RolePlaying\Magic\Effects\Effect;

final readonly class Sorcery implements Spell
{
    public static function of(string $name, int $cost, int $duration, Effect $effect): self
    {
        assert($duration > 0);
        assert($cost > 0);
        return new self($name, $cost, duration: $duration, effect: $effect);
    }

    public static function permanent(string $name, Effect $effect): self
    {
        return new self($name, cost: 0, duration: PHP_INT_MAX, effect: $effect);
    }

    public function __construct(
        public string $name,
        public int $cost,
        public int $duration,
        public Effect $effect,
    ) {
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
