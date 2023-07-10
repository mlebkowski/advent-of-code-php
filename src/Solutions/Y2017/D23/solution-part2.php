<?php
declare(strict_types=1);

$a = 1;
$b = 0;
$c = 0;
$d = 0;
$e = 0;
$f = 0;
$g = 0;
$h = 0;

$b = 79;
$c = $b;
if ($a !== 0) {
    $b *= 100;
    $b += 100000;
    $c = $b;
    $c += 17000;
}

while (true) {
    $f = 1;
    $d = 2;
    do {
        $e = 2;
        do {
            $g = $d * $e - $b;
            if ($g === 0) {
                $f = 0;
            }
            ++$e;
            $g = $e - $b;
        } while ($g !== 0);
        ++$d;
        $g = $d - $b;
    } while ($g !== 0);
    if ($f === 0) {
        ++$h;
    }
    // if (!isPrime($b)) {
    //     ++$h;
    // }
    $g = $b - $c;
    if ($g === 0) {
        echo $h, "\n";
        return;
    }
    $b += 17;
}

function isPrime($num)
{
    for ($i = 2, $s = sqrt($num); $i <= $s; $i++) {
        if ($num % $i === 0) {
            return false;
        }
    }
    return $num > 1;
}
