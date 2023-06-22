<?php

declare(strict_types=1);

namespace App\Realms\RolePlaying\Evolution;

use App\Realms\RolePlaying\Character;
use App\Realms\RolePlaying\Magic\Sorcery;

final readonly class Context
{
    public static function of(Character $enemy, int $hitPoints, int $mana, ?Sorcery $effect): self
    {
        return new self($enemy, $hitPoints, $mana, $effect);
    }

    private function __construct(
        public Character $enemy,
        public int $hitPoints,
        public int $mana,
        public ?Sorcery $effect,
    ) {
    }

    public function enemy(): Character
    {
        return clone $this->enemy;
    }

    public function effect(): ?Sorcery
    {
        return $this->effect ? clone $this->effect : null;
    }
}
