<?php

declare(strict_types=1);

namespace App\Realms\RolePlaying\Combat\Problems;

use App\Realms\RolePlaying\Magic\Sorcery;
use Exception;

final class CannotApplyEffect extends Exception
{
    /**
     * @throws CannotApplyEffect
     */
    public static function whenSorceryExhausted(bool $exhausted, Sorcery $sorcery): void
    {
        $exhausted && throw new self("Cannot apply effect of exhausted $sorcery spell");
    }
}
