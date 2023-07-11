<?php

declare(strict_types=1);

namespace App\Solutions\Y2018\D04;

use App\Aoc\Parser\Matcher;
use App\Aoc\Runner\InputParser;
use App\Solutions\Y2018\D04\Event\EventFactory;
use App\Solutions\Y2018\D04\Event\EventLog;

/** @implements InputParser<ReposeRecordInput> */
final class ReposeRecordInputParser implements InputParser
{
    public function parse(string $input): object
    {
        $matcher = Matcher::simple('[%s %5s] %...', EventFactory::factory(...));
        return new ReposeRecordInput(EventLog::of(...$matcher->matchLines($input)));
    }
}
