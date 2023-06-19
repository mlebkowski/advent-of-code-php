<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D21\Problems;

use Exception;

final class NoItemByThatName extends Exception
{
    public static function ofName(string $name): self
    {
        return new self("There is no item '$name'");
    }
}
