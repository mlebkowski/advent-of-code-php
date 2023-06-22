<?php

declare(strict_types=1);

namespace App\Realms\RolePlaying\Combat;

use App\Realms\RolePlaying\Character;
use Stringable;

final readonly class Turn implements Stringable
{
    public static function of(Attack $attack, SpellEffect ...$spellEffects): self
    {
        return new self(implode("\n", [...$spellEffects, $attack]), $attack);
    }

    public static function winning(Character $winner, Character $loser, SpellEffect...$spellEffects): self
    {
        $winningMessage = "This kills the $loser, and the $winner wins.";
        return new self(implode("\n", [...$spellEffects, $winningMessage]));
    }

    private function __construct(private string $message, public ?Attack $attack = null)
    {
    }

    public function __toString(): string
    {
        return $this->message;
    }
}
