<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D02\Move;

final readonly class Move
{
    public function __construct(/** @var Direction[] */ public array $directions)
    {
    }
}
