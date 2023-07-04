<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D09\Parser\Problems;

use App\Solutions\Y2017\D09\Parser\Tokenizer;
use App\Solutions\Y2017\D09\Parser\Type;
use Exception;
use Throwable;

final class TokenExpected extends Exception
{
    /**
     * @throws Throwable
     */
    public static function ofType(Tokenizer $tokenizer, Type $expected): void
    {
        $actual = $tokenizer->peek();

        null === $actual && $tokenizer->croak(new self(
            "Expected token of type $expected->name but no token found",
        ));

        $actualType = $actual->type->name;
        $actual->type !== $expected && $tokenizer->croak(new self(
            "Expected token of type $expected->name but $actualType found",
        ));
    }
}
