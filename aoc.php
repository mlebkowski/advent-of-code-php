#!/usr/bin/env php
<?php

declare(strict_types=1);

namespace App\Aoc;

// region setup
use App\Aoc\Progress\Progress;
use App\Aoc\Runner\Runner;

require_once __DIR__ . '/vendor/autoload.php';
ini_set('error_reporting', E_ALL & ~E_DEPRECATED);
/** @var InputFetcher $fetcher */
$fetcher = require 'config/fetcher.php';
/** @var SolutionFactory $factory */
$factory = require 'config/solutionFactory.php';
/** @var Runner $runner */
$runner = require 'config/runner.php';
// endregion

Progress::dieAfter((int)getenv('MAX_ITERATIONS'));
$challenge = $factory->mostRecentChallenge();
if (2 === count($argv)) {
    $challenge = $challenge->secondPart();
}

if (4 === count($argv)) {
    $challenge = Challenge::fromArgv($argv);
}

$solution = $factory->make($challenge);
$input = $fetcher->fetch($challenge);

echo $challenge, "\n", '---', "\n\n";
if ($input->sample) {
    $runner->run($solution, $challenge, 'sample', $input->sample, $input->expected);
}

$runner->run($solution, $challenge, 'challenge', $input->actual);
