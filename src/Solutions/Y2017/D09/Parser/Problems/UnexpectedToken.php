<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D09\Parser\Problems;

use App\Solutions\Y2017\D09\Parser\Token;
use App\Solutions\Y2017\D09\Parser\Type;
use Exception;

final class UnexpectedToken extends Exception
{
    /**
     * @throws UnexpectedToken
     */
    public static function whenOfType(Type $type, ?Token $actual): void
    {
        $actual?->type === $type && throw new self("Unexpected token of type: $type->name");
    }

    public static function of(Token $token): self
    {
        $name = $token->type->name;
        return new self("Unexpected token [$name], $token->value");
    }
}
