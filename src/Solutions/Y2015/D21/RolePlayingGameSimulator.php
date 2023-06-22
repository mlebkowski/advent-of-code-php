<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D21;

use App\Aoc\Challenge;
use App\Aoc\Progress\Progress;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;
use App\Realms\RolePlaying\Inventory\Item;
use App\Realms\RolePlaying\Inventory\ItemType;
use App\Realms\RolePlaying\WarriorBuilder;
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
        $boss = WarriorBuilder::start('boss', $input->hitPoints)
            ->withItems(
                Item::of('boss item', $input->damage, $input->armor, ItemType::Weapon),
            )
            ->build();

        $positivePointsRequired = $boss->attack + $boss->armor();

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
