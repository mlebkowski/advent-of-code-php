<?php

declare(strict_types=1);

namespace App\Aoc;

// region setup
use App\Aoc\Discovery\ImplementationsDiscovery;
use App\Aoc\Runner\ChallengeInputParser;
use App\Aoc\Runner\InputFactory;
use App\Aoc\Runner\Runner;

require_once __DIR__ . '/vendor/autoload.php';

$sessionKey = getenv('AOC_SESSION_KEY');
$challenge = Challenge::fromArgv($argv);
assert(128 === strlen($sessionKey));

$fetcher = new InputFetcher(__DIR__ . '/var', $sessionKey);
$implementationsDiscovery = new ImplementationsDiscovery(__DIR__ . '/src/Solutions');
$factory = new SolutionFactory($implementationsDiscovery);
$runner = new Runner(new ChallengeInputParser(new InputFactory($implementationsDiscovery)));
// endregion

$solution = $factory->make($challenge);
$input = $fetcher->fetch($challenge);

echo $challenge, "\n", '---', "\n\n";
if ($input->sample) {
    $runner->run($solution, $challenge, 'sample', $input->sample, $input->expected);
}

$runner->run($solution, $challenge, 'challenge', $input->actual);
