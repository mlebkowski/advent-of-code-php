<?php

declare(strict_types=1);

namespace App\Realms\RolePlaying;

use App\Realms\RolePlaying\Magic\Problems\NotEnoughMana;
use PHPUnit\Framework\TestCase;

final class CharacterTest extends TestCase
{
    public function test cannot cast spells without sufficient mana(): void
    {
        $this->expectException(NotEnoughMana::class);
        $wizard = CharacterMother::withSpells('player', 10, 10, 'Magic Missile');
        $wizard->castSpell();
    }
    
    public function test cycles spells(): void
    {
        $wizard = CharacterMother::withSpells('player', 10, 1000, 'Magic Missile', 'Shield');
        self::assertNotEquals($wizard->castSpell(), $wizard->castSpell());
    }
}
