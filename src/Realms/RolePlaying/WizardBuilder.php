<?php

declare(strict_types=1);

namespace App\Realms\RolePlaying;

use App\Realms\RolePlaying\Magic\Spell;

final class WizardBuilder
{
    private array $spells = [];

    public static function start(string $name, int $hp, int $mana): self
    {
        return new self($name, $hp, $mana);
    }

    private function __construct(
        private readonly string $name,
        private readonly int $hp,
        private readonly int $mana,
    ) {
    }

    public function withSpells(Spell ...$spells): self
    {
        $this->spells = array_merge($this->spells, $spells);
        return $this;
    }

    public function build(): Character
    {
        return Character::of(
            $this->name,
            $this->hp,
            $this->mana,
            ...$this->spells,
        );
    }
}
