<?php

declare(strict_types=1);

namespace App\Realms\RolePlaying\Magic\Effects;

use App\Realms\RolePlaying\Character;
use App\Realms\RolePlaying\Magic\Cleanup\Cleanup;

interface Effect
{
    public function apply(Character $caster, Character ...$opponents): ?Cleanup;
}
