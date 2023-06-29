#!/usr/bin/env php
<?php

declare(strict_types=1);

use App\Aoc\SolutionFactory;

require_once './vendor/autoload.php';

[, $year, $day, $name] = array_pad($argv, 4, null);

/** @var SolutionFactory $solutionsFactory */
$solutionsFactory = require 'config/solutionFactory.php';
$nextChallenge = $solutionsFactory->mostRecentChallenge()->next();

$yearRange = range(2015, 2022);
while (false === in_array((int)$year, $yearRange, true)) {
    $year = readline(sprintf('Please specify year [%d]: ', $nextChallenge->year)) ?: $nextChallenge->year;
}
$dayRange = range(1, 25);
while (false === in_array((int)$day, $dayRange, true)) {
    $day = readline(sprintf('Please specify day [%d]: ', $nextChallenge->day)) ?: $nextChallenge->day;
}
while (!$name) {
    $name = readline('Please specify the name: ');
}

$source = __DIR__ . '/template/';
$dayPad = sprintf('%02d', $day);
$name = implode("", array_map('ucfirst', explode(" ", $name)));
$targetDir = __DIR__ . "/src/Solutions/Y$year/D$dayPad";

is_dir($targetDir) || mkdir($targetDir, recursive: true);
foreach (glob($source . '*.php') as $file) {
    file_put_contents(
        $targetDir . '/' . str_replace('NAME', $name, basename($file)),
        strtr(
            file_get_contents($file),
            [
                '0000' => $year,
                '00' => $dayPad,
                '0' => $day,
                'NAME' => $name,
            ],
        ),
    );
}
