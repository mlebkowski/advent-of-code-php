<?php
declare(strict_types=1);

use App\Solutions\Y2017\D11\HexEdInputParser;
use App\Solutions\Y2017\D11\StepCounter;
use loophp\collection\Collection;

require_once __DIR__ . '/../../../../vendor/autoload.php';

// region load
$input = file_get_contents(__DIR__ . '/../../../../var/2017-11.txt');
$directions = (new HexEdInputParser())->parse($input)->directions;
$path = iterator_to_array(StepCounter::count(...$directions));
// endregion
// region basic constraints
$stepCount = count($directions);
$max = max($path);
[$height, $width] = array_map(
    static fn (string $value) => (int)$value,
    explode(' ', shell_exec("stty size")),
);
$height--;
$height = min(25, $height);
$width = min(100, $width);
$height = (int)floor($height / 3) * 3;
$corner = '└';
$left = '│';
$bottom = '─';
// endregion
// region calculate canvas
$chartGutter = 1;
$labelWidth = strlen((string)$max);
$legendWidth = strlen((string)$max) + 2 * $chartGutter;
$axis = 1;
$chartWidth = $width - $legendWidth - $axis - $chartGutter * 2;
$chartHeight = $height - $chartGutter - $axis;
$chunkSize = (int)ceil($stepCount / $chartWidth);
// endregion
// region helpers
$withValue = static fn (string $top, string $bottom, Closure $fn) => Collection::range(0, $chartHeight)
    ->mapN(
        static fn (float $chartRowNo) => (int)floor(
            $max * ($chartHeight - $chartRowNo) / $chartHeight,
        ),
        $fn,
    )
    ->prepend($top)
    ->append($bottom)
    ->all();
// endregion
$canvas = [
    // legend
    array_fill(0, $height, ' '),
    $withValue(
        str_repeat(' ', $labelWidth),
        str_repeat(' ', $labelWidth),
        static fn (int $value, int $idx) => str_pad(
            $idx % 3 === 0 ? (string)$value : '',
            $labelWidth,
            pad_type: STR_PAD_LEFT,
        ),
    ),
    array_fill(0, $height, ' '),
    ['^', ...array_fill(0, $height - 2, $left), $corner],
    [...array_fill(0, $height - 1, ' '), $bottom],
    ...
    Collection::fromIterable($path)
        ->chunk($chunkSize)
        ->map(static function (array $chunk) use ($withValue, $bottom) {
            $value = (int)floor(array_sum($chunk) / count($chunk));

            return $withValue(
                ' ',
                $bottom,
                static fn (int $chartValue) => $value >= $chartValue ? '▓' : ' ',
            );
        })
        ->all(),

];

echo Collection::fromIterable($canvas)
    ->transpose()
    ->map(static fn (array $elements) => implode('', $elements))
    ->implode("\n"), "\n";
