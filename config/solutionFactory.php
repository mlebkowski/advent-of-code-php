<?php
declare(strict_types=1);

use App\Aoc\SolutionFactory;

$implementationsDiscovery = require 'implementationsDiscovery.php';
return new SolutionFactory($implementationsDiscovery);
