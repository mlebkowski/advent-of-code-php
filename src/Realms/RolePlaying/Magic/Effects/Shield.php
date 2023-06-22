<?php

declare(strict_types=1);

namespace App\Realms\RolePlaying\Magic\Effects;

use App\Realms\RolePlaying\Character;
use App\Realms\RolePlaying\Magic\Cleanup\Cleanup;
use App\Realms\RolePlaying\Magic\Cleanup\ReduceArmor;

final readonly class Shield implements Effect
{
    public static function of(int $value): self
    {
        return new self($value);
    }

    private function __construct(private int $value)
    {
    }

    public function apply(Character $caster, int $iteration, Character ...$opponents): ?Cleanup
    {
        $caster->increaseArmor($this->value);

        return ReduceArmor::of($this->value, $caster);
    }

    public function __toString(): string
    {
        return sprintf('increases armor by %s', $this->value);
    }
}
