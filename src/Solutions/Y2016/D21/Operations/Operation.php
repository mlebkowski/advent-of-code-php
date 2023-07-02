<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D21\Operations;

use Stringable;

interface Operation extends Stringable
{
    public function scramble(string $input): string;

    public function reverse(string $input): string;
}
