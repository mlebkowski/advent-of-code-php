<?php

declare(strict_types=1);

namespace App\Realms\RolePlaying\Magic;

use Exception;

final class NoSpellByThatName extends Exception
{
    public static function of(string $name): self
    {
        return new self("No spell named '$name'");
    }
}
