<?php
declare(strict_types=1);

namespace App\Realms\Computing\IO;

interface Device
{
    public function consumeOutputBuffer(): iterable;
}
