<?php

declare(strict_types=1);

namespace App\Realms\RolePlaying;

use App\Realms\RolePlaying\Inventory\ItemPrice;
use App\Realms\RolePlaying\Inventory\ItemsFactory;
use App\Realms\RolePlaying\Inventory\NoItemByThatName;
use App\Realms\RolePlaying\Inventory\Problems\InventoryProblem;
use App\Realms\RolePlaying\Magic\NoSpellByThatName;
use App\Realms\RolePlaying\Magic\Spell;
use App\Realms\RolePlaying\Magic\SpellFactory;
use loophp\collection\Collection;

final class CharacterMother
{
    /**
     * @throws InventoryProblem
     */
    public static function withItems(string $name, int $hitPoints, string ...$names): Character
    {
        $stock = Collection::fromIterable(ItemsFactory::all())
            ->map(static fn (ItemPrice $itemPrice) => [$itemPrice->item->name, $itemPrice->item])
            ->unpack()
            ->all(false);

        $items = Collection::fromIterable($names)
            ->map(static fn (string $name) => $stock[$name] ?? NoItemByThatName::ofName($name))
            ->all();

        return WarriorBuilder::start($name, $hitPoints)
            ->withItems(...$items)
            ->build();
    }

    public static function withSpells(string $name, int $hitPoints, int $mana, string ...$names): Character
    {
        $spellBook = Collection::fromIterable(SpellFactory::all())
            ->map(static fn (Spell $spell) => [(string)$spell, $spell])
            ->unpack()
            ->all(false);
        $spells = Collection::fromIterable($names)
            ->map(static fn (string $name) => $spellBook[$name] ?? NoSpellByThatName::of($name))
            ->all();

        return WizardBuilder::start($name, $hitPoints, $mana)
            ->withSpells(...$spells)
            ->build();
    }

    public static function some(): Character
    {
        return Character::of('player', 10, 10);
    }
}
