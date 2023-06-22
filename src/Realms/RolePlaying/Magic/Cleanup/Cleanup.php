<?php

declare(strict_types=1);

namespace App\Realms\RolePlaying\Magic\Cleanup;

interface Cleanup
{
    public function apply(): void;
}
