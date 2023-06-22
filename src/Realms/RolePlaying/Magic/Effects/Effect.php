<?php

declare(strict_types=1);

namespace App\Realms\RolePlaying\Magic\Effects;

use App\Realms\RolePlaying\Character;
use App\Realms\RolePlaying\Magic\Cleanup\Cleanup;
use Stringable;

interface Effect extends Stringable
{
    public function apply(Character $caster, int $iteration, Character ...$opponents): ?Cleanup;
}
