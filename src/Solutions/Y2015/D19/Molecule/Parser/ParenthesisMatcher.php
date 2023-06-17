<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D19\Molecule\Parser;

final class ParenthesisMatcher
{
    private const OpenBracket = '(';
    private const Separator = ',';
    private const CloseBracket = ')';

    public static function march(string $input): Parenthesis|null
    {
        $firstOpenBracketPosition = strpos($input, self::OpenBracket);

        if (false === $firstOpenBracketPosition) {
            return null;
        }

        $leftPart = substr($input, 0, $firstOpenBracketPosition);
        $openCount = 0;
        $arguments = [];
        $cursor = $firstOpenBracketPosition + 1;
        $buffer = '';
        $max = strlen($input);

        while ($cursor < $max) {
            $char = $input[$cursor++];
            switch ($char) {
                case self::OpenBracket:
                    $openCount++;
                    $buffer .= $char;
                    break;
                case self::Separator:
                    if ($openCount === 0) {
                        $arguments[] = $buffer;
                        $buffer = '';
                    }
                    break;
                case self::CloseBracket:
                    if ($openCount === 0) {
                        $arguments[] = $buffer;
                        break 2;
                    }
                    $openCount--;
                    $buffer .= $char;

                    break;
                default:
                    $buffer .= $char;
            }
        }

        return new Parenthesis($cursor, $leftPart, $arguments);
    }
}
