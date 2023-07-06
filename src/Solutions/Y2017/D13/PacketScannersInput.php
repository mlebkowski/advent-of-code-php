<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D13;

final readonly class PacketScannersInput
{
    public function __construct(/** @var Spec[] */ public array $specs)
    {
    }
}
