<?php

declare(strict_types=1);

namespace App\Realms\RolePlaying\Magic\Effects;

use App\Realms\RolePlaying\Character;
use App\Realms\RolePlaying\Magic\Cleanup\Cleanup;

final readonly class Damage implements Effect
{
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
        foreach ($opponents as $opponent) {
            $opponent->reduceHitPoints($this->value);
        }

        return null;
    }
}
