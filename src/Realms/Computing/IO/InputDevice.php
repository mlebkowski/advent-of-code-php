<?php
declare(strict_types=1);

namespace App\Realms\Computing\IO;

use App\Realms\Computing\IO\Problems\ReadWait;

interface InputDevice
{
    /**
     * @throws ReadWait
     */
    public function nextValue(): int;
}
