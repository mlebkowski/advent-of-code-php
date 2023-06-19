<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D21;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;
use App\Solutions\Y2015\D21\Inventory\Item;
use App\Solutions\Y2015\D21\Inventory\ItemType;
use App\Solutions\Y2015\D21\Strategy\EquipmentRequirementsCalculator;

/** @implements Solution<RolePlayingGameSimulatorInput> */
final class RolePlayingGameSimulator implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2015, 21);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        $boss = Character::of(
            'boss',
            $input->hitPoints,
            Item::of('boss weapon', damage: $input->damage, armor: 0, type: ItemType::Weapon),
            Item::of('boss armor', damage: 0, armor: $input->armor, type: ItemType::Armor),
        );

        return EquipmentRequirementsCalculator::against($boss);
    }
}
