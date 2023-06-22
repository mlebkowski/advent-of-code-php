<?php

declare(strict_types=1);

namespace App\Realms\RolePlaying\Magic\Effects;

use App\Realms\RolePlaying\Character;
use App\Realms\RolePlaying\Magic\Cleanup\Cleanup;

final readonly class Drain implements Effect
{
    public static function of(int $heal, int $damage): self
    {
        return new self(Heal::of($heal), Damage::of($damage));
    }

    private function __construct(private Heal $heal, private Damage $damage)
    {
    }

    public function getName(): string
    {
        return self::class;
    }

    public function apply(Character $caster, Character ...$opponents): ?Cleanup
    {
        $this->heal->apply($caster, ...$opponents);
        $this->damage->apply($caster, ...$opponents);
        return null;
    }
}
