<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D14;

use App\Aoc\Progress\Progress;
use RuntimeException;

final readonly class ScoreFinder
{
    public static function of(int $elves, array $recipes): self
    {
        return new self($elves, $recipes);
    }

    private function __construct(private int $elves, private array $recipes)
    {
    }

    public function find(string $scores, Progress $progress = null): int
    {
        $generator = Scoreboard::of($this->elves, $this->recipes);
        foreach ($generator->generate() as $count => $recipes) {
            $progress?->iterate($count);
            $pos = strpos($recipes, $scores);
            if (false !== $pos) {
                $basePos = max(0, $count - 12);
                return $basePos + $pos;
            }
        }
        throw new RuntimeException('Oops!');
    }
}
