<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D16\Instructions;

use App\Solutions\Y2018\D16\RegisterSet;

interface D16Instruction
{
    public function call(RegisterSet $input): RegisterSet;
}
