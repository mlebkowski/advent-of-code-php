<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D14;

use App\Lib\Type\Cast;

final readonly class ScoreCounter
{
    public static function of(int $elves, array $recipes): self
    {
        return new self(range(0, $elves - 1), $recipes);
    }

    private function __construct(private array $elves, private array $recipes)
    {
        assert(count($this->elves) <= count($this->recipes));
    }

    public function count(int $after): string
    {
        $recipes = $this->recipes;
        $elves = $this->elves;

        while (count($recipes) < $after + 10) {
            $currentRecipes = array_map(
                static fn (int $index) => $recipes[$index],
                $elves,
            );
            $sum = array_sum($currentRecipes);
            $newRecipes = array_map(Cast::toInt(...), str_split("$sum"));
            array_push($recipes, ...$newRecipes);

            $elves = array_map(
                static fn (int $index) => ($index + $recipes[$index] + 1) % count($recipes),
                $elves,
            );
        }

        return implode("", array_slice($recipes, $after, 10));
    }
}
