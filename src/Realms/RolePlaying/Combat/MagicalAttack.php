<?php

declare(strict_types=1);

namespace App\Realms\RolePlaying\Combat;

use App\Realms\RolePlaying\Character;
use App\Realms\RolePlaying\Combat\Problems\NoDuplicateEffects;
use App\Realms\RolePlaying\Magic\Instant;
use App\Realms\RolePlaying\Magic\Problems\NotEnoughMana;
use App\Realms\RolePlaying\Magic\Sorcery;
use App\Realms\RolePlaying\Magic\Spell;

final readonly class MagicalAttack implements Attack
{
    public static function of(ActiveSpells $spells, Character $attacker, Character $defender): self
    {
        try {
            $spell = $attacker->castSpell();

            if ($spell instanceof Instant) {
                $spell->effect->apply($attacker, 0, $defender);
                return new self("$attacker casts $spell: $spell->effect.", $spell);
            }

            if ($spell instanceof Sorcery) {
                $spells->add($attacker, $spell);
            }
            return new self("$attacker casts $spell.", $spell);
        } catch (NotEnoughMana|NoDuplicateEffects $e) {
            $attacker->kill();
            return new self("$attacker failed to cast a spell because: {$e->getMessage()}");
        }
    }

    private function __construct(private string $message, public ?Spell $spell = null)
    {
    }

    public function __toString(): string
    {
        return $this->message;
    }
}
