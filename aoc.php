<?php

declare(strict_types=1);

namespace App\Aoc;

// region setup
use App\Aoc\Progress\Progress;

require_once __DIR__ . '/vendor/autoload.php';

$fetcher = require 'config/fetcher.php';
$factory = require 'config/solutionFactory.php';
$runner = require 'config/runner.php';
// endregion

Progress::dieAfter((int)getenv('MAX_ITERATIONS'));
$challenge = Challenge::fromArgv($argv);

$solution = $factory->make($challenge);
$input = $fetcher->fetch($challenge);

echo $challenge, "\n", '---', "\n\n";
if ($input->sample) {
    $runner->run($solution, $challenge, 'sample', $input->sample, $input->expected);
}

$runner->run($solution, $challenge, 'challenge', $input->actual);
