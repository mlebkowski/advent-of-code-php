<?php declare(strict_types=1);

foreach (range(2, 16) as $length) {
    $values = [];
    $row = '';
    foreach (range(0, $length - 1) as $pos) {
        $values[] = $target = ($pos + 1 + $pos + ($pos >= $length / 2 ? 1 : 0)) % $length;
        $row .= str_pad((string)$target, 3, ' ', STR_PAD_LEFT);
    }
    $unique = count($values) === count(array_unique($values)) ? '✔' : '✘';
    printf('%3d (%s):%s' . "\n", $length, $unique, $row);
}
