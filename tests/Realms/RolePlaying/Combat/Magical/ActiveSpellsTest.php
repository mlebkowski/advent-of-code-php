<?php

declare(strict_types=1);

namespace App\Realms\RolePlaying\Combat\Magical;

use App\Realms\RolePlaying\CharacterMother;
use App\Realms\RolePlaying\Combat\ActiveSpells;
use App\Realms\RolePlaying\Combat\Problems\NoDuplicateEffects;
use App\Realms\RolePlaying\Magic\Effects\Damage;
use App\Realms\RolePlaying\Magic\Sorcery;
use PHPUnit\Framework\TestCase;

final class ActiveSpellsTest extends TestCase
{
    public function test disallows duplicate spells(): void
    {
        self::expectException(NoDuplicateEffects::class);

        $character = CharacterMother::some();
        $sut = ActiveSpells::none();
        $sut->add(
            $character,
            Sorcery::of(name: "Poison", cost: 100, duration: 1, effect: Damage::of(1)),
        );
        $sut->add(
            $character,
            Sorcery::of(name: "Poison", cost: 100, duration: 1, effect: Damage::of(1)),
        );
    }

    public function test applies the effect only for its duration(): void
    {
        $startingHitPoints = 100;
        $spellDuration = 6;
        $spellDamage = 3;
        $expectedDamage = $spellDamage * $spellDuration;

        $player = CharacterMother::withSpells('player', 1000, 173, 'Poison');
        $opponent = CharacterMother::withItems('boss', $startingHitPoints, 'Dagger');
        $sut = ActiveSpells::none();
        $sut->add($player, $player->castSpell());

        // region a couple of turns
        foreach (range(1, 20) as $turn) {
            $sut->apply($opponent, $player);
            $sut->apply($player, $opponent);
        }
        // endregion

        self::assertSame($startingHitPoints - $expectedDamage, $opponent->hitPoints());
    }
}
