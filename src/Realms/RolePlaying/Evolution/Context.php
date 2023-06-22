<?php

declare(strict_types=1);

namespace App\Realms\RolePlaying\Evolution;

use App\Realms\RolePlaying\Character;

final readonly class Context
{
    public static function of(Character $enemy, int $hitPoints, int $mana): self
    {
        return new self($enemy, $hitPoints, $mana);
    }

    private function __construct(public Character $enemy, public int $hitPoints, public int $mana)
    {
    }

    public function enemy(): Character
    {
        return clone $this->enemy;
    }
}
