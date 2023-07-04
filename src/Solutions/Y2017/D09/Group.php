<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D09;

use Stringable;

final readonly class Group implements Stringable
{
    public static function of(Group ...$groups): self
    {
        return new self($groups);
    }

    private function __construct(private array $groups)
    {
    }

    public function score(int $weight = 1): int
    {
        return $weight + array_sum(
            array_map(
                static fn (Group $group) => $group->score($weight + 1),
                $this->groups,
            ),
        );
    }

    public function __toString(): string
    {
        return '{' . implode(',', $this->groups) . '}';
    }
}
