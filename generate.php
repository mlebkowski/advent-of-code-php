<?php

declare(strict_types=1);

[, $year, $day, $name] = $argv;
$source = __DIR__ . '/template/';

$name = implode("", array_map('ucfirst', explode(" ", $name)));
$targetDir = __DIR__ . "/src/Solutions/Y$year/D$day";

is_dir($targetDir) || mkdir($targetDir, recursive: true);
foreach (glob($source . '*.php') as $file) {
    file_put_contents(
        $targetDir . '/' . str_replace('NAME', $name, basename($file)),
        strtr(file_get_contents($file), ['0000' => $year, '00' => $day, 'NAME' => $name]),
    );
}
