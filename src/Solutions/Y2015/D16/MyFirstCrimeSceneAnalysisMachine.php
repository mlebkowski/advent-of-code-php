<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D16;

use App\Aoc\Challenge;
use App\Aoc\Progress;
use App\Aoc\Solution;
use loophp\collection\Collection;

/** @implements Solution<AuntsInput> */
final class MyFirstCrimeSceneAnalysisMachine implements Solution
{
    private readonly array $criteria;

    public function __construct()
    {
        $this->criteria = [
            new AttributeValue(Attribute::Children, 3),
            new AttributeValue(Attribute::Cats, 7),
            new AttributeValue(Attribute::Samoyeds, 2),
            new AttributeValue(Attribute::Pomeranians, 3),
            new AttributeValue(Attribute::Akitas, 0),
            new AttributeValue(Attribute::Vizslas, 0),
            new AttributeValue(Attribute::Goldfish, 5),
            new AttributeValue(Attribute::Trees, 3),
            new AttributeValue(Attribute::Cars, 2),
            new AttributeValue(Attribute::Perfumes, 1),
        ];
    }

    public function challenges(): iterable
    {
        return Challenge::bothParts(2015, 16);
    }

    public function solve(Challenge $challenge, mixed $input): string
    {
        $aunts = $input->aunts;

        $criteria = Collection::fromIterable($this->criteria);
        $progress = Progress::ofExpectedIterations(count($aunts));
        $outdatedRetroEncabulator = $challenge->isPartTwo();

        return Collection::fromIterable($aunts)
            ->apply($progress->delay(5_000))
            ->apply($progress->step(...))
            ->apply($progress->report(...))
            ->filter(
                static fn (Sue $sue) => $criteria->every(
                    static fn (AttributeValue $attributeValue) => $sue->matches(
                        $attributeValue,
                        $outdatedRetroEncabulator,
                    ),
                ),
            )
            ->map(static fn (Sue $sue) => $sue->name)
            ->apply($progress->report(...))
            ->first('Not found :(');
    }

}
