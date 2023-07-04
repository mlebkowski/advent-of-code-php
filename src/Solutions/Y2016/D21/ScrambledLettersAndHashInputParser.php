<?php

declare(strict_types=1);

namespace App\Solutions\Y2016\D21;

use App\Aoc\Parser\MatcherBuilder;
use App\Aoc\Runner\InputParser;
use App\Solutions\Y2016\D21\Operations\MovePosition;
use App\Solutions\Y2016\D21\Operations\ReverseRange;
use App\Solutions\Y2016\D21\Operations\RotateBasedOnLetter;
use App\Solutions\Y2016\D21\Operations\RotateLeft;
use App\Solutions\Y2016\D21\Operations\RotateRight;
use App\Solutions\Y2016\D21\Operations\SwapLetters;
use App\Solutions\Y2016\D21\Operations\SwapPositions;

/** @implements InputParser<ScrambledLettersAndHashInput> */
final class ScrambledLettersAndHashInputParser implements InputParser
{
    public function parse(string $input): object
    {
        $matcher = MatcherBuilder::create()
            ->startsWith('swap position', '%d with position %d', SwapPositions::of(...))
            ->startsWith('swap letter', '%s with letter %s', SwapLetters::of(...))
            ->startsWith('rotate left', '%d steps', RotateLeft::of(...))
            ->startsWith('rotate right', '%d steps', RotateRight::of(...))
            ->startsWith('rotate based on position of letter', '%s', RotateBasedOnLetter::of(...))
            ->startsWith('reverse positions', '%d through %d', ReverseRange::of(...))
            ->startsWith('move position', '%d to position %d', MovePosition::of(...))
            ->getMatcher();

        return new ScrambledLettersAndHashInput($matcher->matchLines($input));
    }
}
