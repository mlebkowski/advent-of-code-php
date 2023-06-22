<?php

declare(strict_types=1);

namespace App\Realms\RolePlaying\Magic\Effects;

use App\Realms\RolePlaying\Character;
use App\Realms\RolePlaying\Magic\Cleanup\Cleanup;

final readonly class Heal implements Effect
{
    public static function of(int $value): self
    {
        return new self($value);
    }

    private function __construct(public int $value)
    {
        assert($this->value > 0);
    }

    public function apply(Character $caster, int $iteration, Character ...$opponents): ?Cleanup
    {
        $caster->gainHitPoints($this->value);
        return null;
    }

    public function __toString(): string
    {
        return sprintf('heals %d hit points', $this->value);
    }
}
