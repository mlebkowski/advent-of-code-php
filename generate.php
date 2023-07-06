#!/usr/bin/env php
<?php

declare(strict_types=1);

use App\Aoc\InputFetcher;
use App\Aoc\SolutionFactory;

require_once './vendor/autoload.php';

$noInteraction = (bool)getenv('NO_INTERACTION');
[, $year, $day, $name] = array_pad($argv, 4, null);

/** @var SolutionFactory $solutionsFactory */
$solutionsFactory = require 'config/solutionFactory.php';
/** @var InputFetcher $fetcher */
$fetcher = require 'config/fetcher.php';

$nextChallenge = $solutionsFactory->mostRecentChallenge()->next();

$ask = static fn (string $prompt, string|int $default) => $noInteraction
    ? $default
    : (readline("$prompt [$default]: ") ?: $default);

$yearRange = range(2015, 2022);
while (false === in_array((int)$year, $yearRange, true)) {
    $year = $ask('Please specify year', $nextChallenge->year);
}
$dayRange = range(1, 25);
while (false === in_array((int)$day, $dayRange, true)) {
    $day = $ask('Please specify day', $nextChallenge->day);
}

if (!$name) {
    $html = file_get_contents("https://adventofcode.com/$nextChallenge->year/day/$nextChallenge->day");
    preg_match('/<h2>--- Day \d+: (.+) ---<\/h2>/', $html, $match);
    $default = end($match);
    $name = $ask('Please specify the name', $default);
}

$source = __DIR__ . '/template/';
$dayPad = sprintf('%02d', $day);
$name = implode(
    "",
    array_map(
        ucfirst(...),
        preg_split("/[^[a-z0-9]+/i", strtr($name, ['\'' => ''])),
    ),
);
$targetDir = __DIR__ . "/src/Solutions/Y$year/D$dayPad";

echo "Generating Y$year/D$dayPad/$name\n";
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

echo "Fetching input for $nextChallenge\n";
$fetcher->fetch($nextChallenge);
