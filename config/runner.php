<?php
declare(strict_types=1);

use App\Aoc\Runner\ChallengeInputParser;
use App\Aoc\Runner\InputFactory;
use App\Aoc\Runner\Runner;

$implementationsDiscovery = require 'implementationsDiscovery.php';
return new Runner(new ChallengeInputParser(new InputFactory($implementationsDiscovery)));
