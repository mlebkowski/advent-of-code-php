<?php

declare(strict_types=1);

namespace App\Realms\RolePlaying\Magic\Cleanup;

use Stringable;

interface Cleanup extends Stringable
{
    public function apply(): void;
}
