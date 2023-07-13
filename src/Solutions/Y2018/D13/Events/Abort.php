<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D13\Events;

final readonly class Abort
{
    public static function of(): self
    {
        return new self();
    }

    private function __construct()
    {
    }
}
