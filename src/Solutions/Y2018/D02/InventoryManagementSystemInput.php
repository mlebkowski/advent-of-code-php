<?php

declare(strict_types=1);

namespace App\Solutions\Y2018\D02;

final readonly class InventoryManagementSystemInput
{
    public function __construct(/** @var Id[] */ public array $ids)
    {
    }
}
