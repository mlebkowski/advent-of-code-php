<?php

declare(strict_types=1);

namespace App\Realms\RolePlaying\Combat\Problems;

use App\Realms\RolePlaying\Magic\Sorcery;
use Exception;

final class NoDuplicateEffects extends Exception
{
    /**
     * @throws NoDuplicateEffects
     */
    public static function whenAlreadyActive(bool $exists, Sorcery $spell): void
    {
        $exists && throw new self("Cannot cast second $spell while it effects are still active");
    }
}
