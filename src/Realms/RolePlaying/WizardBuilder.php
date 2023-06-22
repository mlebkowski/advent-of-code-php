<?php

declare(strict_types=1);

namespace App\Realms\RolePlaying;

use App\Realms\RolePlaying\Magic\Spell;

final class WizardBuilder
{
    private array $spells = [];
    private int $mana = 500;

    public static function start(string $name, int $hp): self
    {
        return new self($name, $hp);
    }

    private function __construct(private string $name, private int $hp)
    {
    }

    public function withHitPoints(int $hp): self
    {
        $this->hp = $hp;
        return $this;
    }

    public function withName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function withSpells(Spell ...$spells): self
    {
        $this->spells = array_merge($this->spells, $spells);
        return $this;
    }

    public function withMana(int $mana): self
    {
        $this->mana = $mana;
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
