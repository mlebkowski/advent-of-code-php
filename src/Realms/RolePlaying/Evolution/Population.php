<?php

declare(strict_types=1);

namespace App\Realms\RolePlaying\Evolution;

use App\Realms\RolePlaying\Magic\SpellFactory;
use loophp\collection\Collection;

final readonly class Population
{
    private const MaxPopulation = 100;

    public static function some(Context $context): self
    {
        $spells = iterator_to_array(SpellFactory::all());
        $count = count($spells);
        $spellPerSpecies = 4;

        $species = Collection::range(0, self::MaxPopulation * $spellPerSpecies)
            ->map(static fn (float $i) => $spells[$i % $count])
            ->shuffle()
            ->chunk($spellPerSpecies)
            ->map(static fn (iterable $spells) => Species::of(...$spells))
            ->all();

        return self::ofSpecies(PHP_INT_MAX, 0, $context, ...$species);
    }

    private function __construct(
        public int $solution,
        public int $generation,
        private Context $context,
        public array $speciesResult,
    ) {
    }

    public function advance(): self
    {
        $bestWinner = Collection::fromIterable($this->speciesResult)
            ->filter(static fn (SpeciesResult $result) => $result->winner)
            ->map(static fn (SpeciesResult $result, int $idx) => $idx)
            ->first();

        $species = Collection::fromIterable($this->speciesResult)
            ->slice(0, (int)round(count($this->speciesResult) * 2 / 3))
            ->flatMap(static fn (SpeciesResult $result, int $idx) => [
                $result->species,
                $result->species->mutateIfNotBest($bestWinner === $idx, $result->turns),
            ])
            ->slice(0, self::MaxPopulation)
            ->all();

        $solution = Collection::fromIterable($this->speciesResult)
            ->filter(static fn (SpeciesResult $result) => $result->winner)
            ->reduce(
                static fn (int $solution, SpeciesResult $result) => min($solution, $result->manaSpent),
                $this->solution,
            );

        return self::ofSpecies($solution, $this->generation + 1, $this->context, ...$species);
    }

    private static function ofSpecies(int $solution, int $generation, Context $context, Species ...$species): self
    {
        $results = Collection::fromIterable($species)
            ->distinct(accessorCallback: static fn (Species $species) => $species->name)
            ->map(static fn (Species $species) => SpeciesResult::of($context, $species))
            ->sort(callback: SpeciesResult::compare(...))
            ->all();

        return new self($solution, $generation, $context, $results);
    }
}
