<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D01;

use App\Aoc\Runner\InputParser;

/** @implements InputParser<InverseCaptchaInput> */
final class InverseCaptchaInputParser implements InputParser
{
    public function parse(string $input): object
    {
        return new InverseCaptchaInput(trim($input));
    }
}
