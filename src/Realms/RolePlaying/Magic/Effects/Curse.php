<?php

declare(strict_types=1);

namespace App\Realms\RolePlaying\Magic\Effects;

use App\Realms\RolePlaying\Character;
use App\Realms\RolePlaying\Magic\Cleanup\Cleanup;

final class Curse implements Effect
{
    private int $iteration = 0;

    public static function of(int $value): self
    {
        return new self($value);
    }

    private function __construct(public int $value)
    {
        assert($this->value > 0);
    }

    public function apply(Character $caster, Character ...$opponents): ?Cleanup
    {
        if (++$this->iteration % 2) {
            $caster->reduceHitPoints($this->value);
        }
        return null;
    }

    public function __toString(): string
    {
        return "deals $this->value damage in players turn";
    }
}
