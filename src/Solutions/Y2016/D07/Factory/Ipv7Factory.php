<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D07\Factory;

use App\Solutions\Y2016\D07\Factory\Problems\EmptySequence;
use App\Solutions\Y2016\D07\Ipv7;

final class Ipv7Factory
{
    public static function fromString(string $address): Ipv7
    {
        $mode = NetMode::SuperNet;
        $sequences = [
            NetMode::SuperNet->value => [],
            NetMode::HyperNet->value => [],
        ];

        $buffer = '';
        for ($i = 0; $i < strlen($address); $i++) {
            $char = $address[$i];
            switch ($char) {
                case '[':
                case ']':
                    EmptySequence::whenNothingInBuffer($buffer);
                    $sequences[$mode->value][] = $buffer;
                    $mode = $mode->switchTo(NetMode::of($char));
                    $buffer = '';
                    break;
                default:
                    $buffer .= $char;
            }
        }
        $sequences[$mode->value][] = $buffer;

        return Ipv7::of($sequences[NetMode::SuperNet->value], $sequences[NetMode::HyperNet->value]);
    }
}
