<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D18;

final class RoomDataProvider
{
    public static function data(): iterable
    {
        yield [
            <<<EOF
            ..^^.
            .^^^^
            ^^..^
            EOF,
            6,
        ];

        yield [
            <<<EOF
            .^^.^.^^^^
            ^^^...^..^
            ^.^^.^.^^.
            ..^^...^^^
            .^^^^.^^.^
            ^^..^.^^..
            ^^^^..^^^.
            ^..^^^^.^^
            .^^^..^.^^
            ^^.^^^..^^
            EOF,
            38,
        ];
    }
}
