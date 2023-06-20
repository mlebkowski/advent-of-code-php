<?php

declare(strict_types=1);

namespace App\Realms\RolePlaying\Inventory;

use Exception;

final class NoItemByThatName extends Exception
{
    public static function ofName(string $name): self
    {
        return new self("There is no item '$name'");
    }
}
