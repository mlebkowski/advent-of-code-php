<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D14;

use App\Lib\Type\Cast;
use Generator;

final readonly class Scoreboard
{
    public static function of(int $elves, array $recipes): self
    {
        return new self(range(0, $elves - 1), implode('', $recipes));
    }

    private function __construct(private array $elves, private string $recipes)
    {
        assert(count($this->elves) <= strlen($this->recipes));
    }

    public function generate(): Generator
    {
        $recipes = $this->recipes;
        $elves = $this->elves;

        while (true) {
            $currentRecipes = array_map(
                static fn (int $index) => (int)$recipes[$index],
                $elves,
            );
            $sum = array_sum($currentRecipes);
            $recipes .= implode('', array_map(Cast::toInt(...), str_split("$sum")));
            yield strlen($recipes) => substr($recipes, -12);

            $elves = array_map(
                static fn (int $index) => ($index + (int)$recipes[$index] + 1) % strlen($recipes),
                $elves,
            );
        }
    }
}
