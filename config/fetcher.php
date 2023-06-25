<?php
declare(strict_types=1);

use App\Aoc\InputFetcher;

$sessionKey = getenv('AOC_SESSION_KEY');
assert(128 === strlen($sessionKey));

return new InputFetcher(__DIR__ . '/../var', $sessionKey);
