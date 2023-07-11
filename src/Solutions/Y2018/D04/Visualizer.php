<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D04;

final class Visualizer
{
    public static function visualize(Year $year): string
    {
        $nights = implode("\n", array_map(self::nightToString(...), $year->nights));
        return <<<EOF
        Date   ID     Minute
                      000000000011111111112222222222333333333344444444445555555555
                      012345678901234567890123456789012345678901234567890123456789
        EOF. "\n" . $nights . "\n";
    }

    private static function nightToString(Night $night): string
    {
        return sprintf('%s  #%-4s  %s', $night->date->format('m-d'), $night->guardId, self::periodsToString($night));
    }

    private static function periodsToString(Night $night): string
    {
        $result = str_repeat('.', 60);
        foreach ($night->sleeps as $sleep) {
            $result = substr_replace(
                $result,
                str_repeat('#', $sleep->length()),
                $sleep->start,
                $sleep->length(),
            );
        }
        return strtr($result, ['.' => ' ', '#' => '█']);
    }
}
