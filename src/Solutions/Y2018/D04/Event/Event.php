<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D04\Event;

use DateTimeImmutable;
use Stringable;

interface Event extends Stringable
{
    public function timestamp(): DateTimeImmutable;
}
