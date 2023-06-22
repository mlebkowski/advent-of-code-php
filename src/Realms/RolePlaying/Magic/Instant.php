<?php

declare(strict_types=1);

namespace App\Realms\RolePlaying\Magic;

use App\Realms\RolePlaying\Magic\Effects\Effect;

final readonly class Instant implements Spell
{
    public static function of(string $name, int $cost, Effect $effect): self
    {
        return new self($name, $cost, effect: $effect);
    }

    public function __construct(
        public string $name,
        public int $cost,
        public Effect $effect,
    ) {
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
