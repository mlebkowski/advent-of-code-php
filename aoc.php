<?php

declare(strict_types=1);

namespace App\Aoc;

// region setup
require_once __DIR__ . '/vendor/autoload.php';

$sessionKey = getenv('AOC_SESSION_KEY');
$challenge = Challenge::fromArgv($argv);
assert(128 === strlen($sessionKey));

$fetcher = new InputFetcher(
    __DIR__ . '/var',
    $sessionKey,
);

$factory = new SolutionFactory(
    __DIR__ . '/src',
);

$solution = $factory->make($challenge);
$input = $fetcher->fetch($challenge);
// endregion

echo $challenge, "\n", '---', "\n\n";
if ($input->sample) {
    Runner::run($solution, $challenge, 'sample', $input->sample, $input->expected);
}

Runner::run($solution, $challenge, 'challenge', $input->actual);
