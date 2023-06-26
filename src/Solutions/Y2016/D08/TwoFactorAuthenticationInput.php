<?php

declare(strict_types=1);

namespace App\Solutions\Y2016\D08;

use App\Solutions\Y2016\D08\Operation\Rect;
use App\Solutions\Y2016\D08\Operation\RotateColumn;
use App\Solutions\Y2016\D08\Operation\RotateRow;

final class TwoFactorAuthenticationInput
{
    public function __construct(/** @var Rect[]|RotateColumn[]|RotateRow[] */ public array $operations)
    {
    }
}
