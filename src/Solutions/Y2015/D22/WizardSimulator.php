<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D22;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;
use App\Realms\RolePlaying\Evolution\Context;
use App\Realms\RolePlaying\Evolution\Population;
use App\Realms\RolePlaying\Evolution\SpeciesResult;
use App\Realms\RolePlaying\Inventory\Item;
use App\Realms\RolePlaying\Inventory\ItemType;
use App\Realms\RolePlaying\Magic\Effects\Curse;
use App\Realms\RolePlaying\Magic\Sorcery;
use App\Realms\RolePlaying\WarriorBuilder;
use loophp\collection\Collection;

/** @implements Solution<WizardSimulatorInput> */
final class WizardSimulator implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2015, 22);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): int
    {
        $boss = WarriorBuilder::start('Boss', $input->hitPoints)
            ->withItems(Item::of('BossItem', damage: $input->damage, armor: 0, type: ItemType::Weapon))
            ->build();

        $permanentEffect = $challenge->isPartTwo()
            ? Sorcery::permanent('Hard difficulty', Curse::of(1))
            : null;
        $context = Context::of($boss, hitPoints: 50, mana: 500, effect: $permanentEffect);
        $population = Population::some($context, 100);

        do {
            echo "Generation: $population->generation\n";
            echo Collection::fromIterable($population->speciesResult)
                ->filter(static fn (SpeciesResult $result) => $result->winner)
                ->slice(0, 5)
                ->map(static fn (SpeciesResult $result, int $idx) => sprintf("% 3d. %s", $idx + 1, $result))
                ->implode("\n"), "\n\n";

            $population = $population->advance();
        } while ($population->generation < 2023);

        return $population->solution;
    }
}
