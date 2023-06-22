<?php

declare(strict_types=1);

namespace App\Realms\RolePlaying\Combat;

use App\Realms\RolePlaying\Character;
use Stringable;

final readonly class Turn implements Stringable
{
    public static function of(Attack $attack, SpellEffect ...$spellEffects): self
    {
        return new self(implode("\n", [...$spellEffects, $attack]));
    }

    public static function winning(Character $winner, Character $looser, SpellEffect...$spellEffects)
    {
        $winningMessage = "This kills the $looser, and the $winner wins.";
        return new self(implode("\n", [...$spellEffects, $winningMessage]));
    }

    private function __construct(private string $message)
    {
    }

    public function __toString(): string
    {
        return $this->message;
    }
}
