<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D21;

use App\Aoc\Challenge;
use App\Aoc\Progress\Progress;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;
use App\Solutions\Y2015\D21\Inventory\Item;
use App\Solutions\Y2015\D21\Inventory\ItemType;
use App\Solutions\Y2015\D21\Strategy\InventoriesSatisfyingRequirements;
use App\Solutions\Y2015\D21\Strategy\ShoppingCart;
use loophp\collection\Collection;

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

        $positivePointsRequired = $boss->attack + $boss->armor;

        $progress = Progress::ofExpectedIterations(600)->withDelay(1_500);

        $cheapest = ShoppingCart::cheapest(...);
        $enoughPoints = ShoppingCart::providesEnoughPoints($positivePointsRequired);

        if ($challenge->isPartTwo()) {
            $mostExpensive = static fn ($alpha, $bravo) => -1 * $cheapest($alpha, $bravo);
            $tooLittlePoints = static fn ($cart) => false === $enoughPoints($cart);
        }

        return Collection::fromGenerator(InventoriesSatisfyingRequirements::all())
            ->map(ShoppingCart::of(...))
            ->apply($progress->step(...))
            ->apply($progress->report(...))
            ->filter($tooLittlePoints ?? $enoughPoints)
            ->sort(callback: $mostExpensive ?? $cheapest)
            ->first();
    }
}
