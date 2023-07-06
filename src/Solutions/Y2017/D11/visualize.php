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
$withValue = static fn (Closure $fn) => Collection::range(0, $chartHeight)
    ->mapN(
        static fn (float $chartRowNo) => (int)floor(
            $max * ($chartHeight - $chartRowNo) / $chartHeight,
        ),
        $fn,
    )
    ->all();
// endregion
$canvas = [
    // legend
    array_fill(0, $chartHeight, ' '),
    $withValue(
        static fn (int $value, int $idx) => str_pad(
            $idx % 3 === 0 ? (string)$value : '',
            $labelWidth,
            pad_type: STR_PAD_LEFT,
        ),
    ),
    array_fill(0, $chartHeight, ' '),
    array_fill(0, $chartHeight, $left),
    array_fill(0, $chartHeight, ' '),
    ...
    Collection::fromIterable($path)
        ->chunk($chunkSize)
        ->map(static fn (array $chunk) => $withValue(
            static fn (int $chartValue) => floor(array_sum($chunk) / count($chunk)) >= $chartValue ? '▓' : ' ',
        ))
        ->all(),

];

echo Collection::fromIterable($canvas)
    ->transpose()
    ->map(static fn (array $elements) => implode('', $elements))
    ->prepend(str_repeat(' ', $legendWidth) . '^')
    ->append(str_repeat(' ', $legendWidth) . $corner . str_repeat($bottom, $chartWidth + 2))
    ->implode("\n"), "\n";
