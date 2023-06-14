<?php

declare(strict_types=1);

namespace App\Aoc;

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
$progress = Progress::step(...);

echo $challenge, "\n", '---', "\n\n";
if ($input->sample) {
    Runner::run($solution, $challenge, 'sample', $input->sample, $input->expected);
    // echo "Solving sample";
    // echo "Expecting: {$input->expected}\n";
    // echo "Result: ";
    // $actual = $solution->solve($challenge, $input->sample, $progress);
    // echo "\033[K", var_export($actual, true), "\n\n";
    // if ((string)$actual !== $input->expected) {
    //     exit;
    // }
}

Runner::run($solution, $challenge, 'challenge', $input->actual);
// echo 'Solving challenge', "\n";
// echo 'Result: ';
// $actual = $solution->solve($challenge, $input->actual, $progress);
// echo "\033[K", var_export($actual, true), "\n";
