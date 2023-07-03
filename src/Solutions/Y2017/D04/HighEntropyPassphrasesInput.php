<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D04;

final readonly class HighEntropyPassphrasesInput
{
    public function __construct(public array $passphrases)
    {
    }
}
