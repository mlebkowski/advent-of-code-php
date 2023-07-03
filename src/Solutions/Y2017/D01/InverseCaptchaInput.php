<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D01;

final readonly class InverseCaptchaInput
{
    public function __construct(public string $digits)
    {
    }
}
