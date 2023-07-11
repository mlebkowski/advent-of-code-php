<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D07;

use loophp\collection\Collection;

final readonly class Steps
{
    public static function ofRules(AssemblyRule ...$rules): self
    {
        $steps = Collection::fromIterable($rules)
            ->flatMap(static fn (AssemblyRule $rule) => [$rule->step, $rule->requirement])
            ->distinct()
            ->sort()
            ->all();

        $requirements = Collection::fromIterable($rules)
            ->map(static fn (AssemblyRule $rule) => [$rule->step, $rule->requirement])
            ->unpack()
            ->groupBy(static fn ($value, string $key) => $key)
            ->all(false);

        return new self($steps, $requirements);
    }

    private function __construct(private array $steps, private array $requirements)
    {
    }

    public function ordered(): iterable
    {
        $requirements = $this->requirements;
        $steps = array_flip($this->steps);

        while ($steps) {
            // without requirements:
            $current = key(array_diff_key($steps, $requirements));
            // remove from the remaining steps:
            unset($steps[$current]);

            yield $current;

            foreach ($requirements as $step => $items) {
                $requirements[$step] = array_diff($items, [$current]);
                if (!$requirements[$step]) {
                    unset($requirements[$step]);
                }
            }
        }
    }
}
