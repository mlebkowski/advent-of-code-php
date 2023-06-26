<?php

declare(strict_types=1);

namespace App\Solutions\Y2016\D08;

use App\Aoc\Runner\InputParser;
use App\Solutions\Y2016\D08\Operation\Rect;
use App\Solutions\Y2016\D08\Operation\RotateColumn;
use App\Solutions\Y2016\D08\Operation\RotateRow;
use loophp\collection\Collection;
use RuntimeException;

/** @implements InputParser<TwoFactorAuthenticationInput> */
final class TwoFactorAuthenticationInputParser implements InputParser
{
    public function parse(string $input): object
    {
        preg_match_all(
            '/^
                (?P<operation>rect|rotate\ row|rotate\ column) 
                \s+
                (
                    (?P<width>\d+)x(?P<height>\d+)
                  | y=(?P<row>\d+) \s by \s (?P<rowOffset>\d+)
                  | x=(?P<column>\d+) \s by \s (?P<columnOffset>\d+)
                )
            $/xm',
            $input,
            $matches,
            PREG_SET_ORDER,
        );

        return new TwoFactorAuthenticationInput(
            Collection::fromIterable($matches)
                ->map(static fn (array $operation) => match ($operation['operation']) {
                    'rect' => Rect::of((int)$operation['width'], (int)$operation['height']),
                    'rotate row' => RotateRow::of((int)$operation['row'], (int)$operation['rowOffset']),
                    'rotate column' => RotateColumn::of((int)$operation['column'], (int)$operation['columnOffset']),
                    default => throw new RuntimeException("Unknown operation: {$operation['operation']}"),
                })
                ->all(),
        );
    }
}
