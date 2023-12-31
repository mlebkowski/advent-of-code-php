<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D14;

use RuntimeException;

final readonly class ScoreCounter
{
    public static function of(int $elves, array $recipes): self
    {
        return new self($elves, $recipes);
    }

    private function __construct(private int $elves, private array $recipes)
    {
    }

    public function count(int $after): string
    {
        $generator = Scoreboard::of($this->elves, $this->recipes);
        foreach ($generator->generate() as $count => $recipes) {
            if ($count >= $after + 10) {
                return substr($recipes, $after - ($count - 12), 10);
            }
        }
        throw new RuntimeException('Oops!');
    }
}
