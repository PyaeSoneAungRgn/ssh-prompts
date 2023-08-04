<?php

namespace App\Concerns;

use App\Services\HostService;
use function Laravel\Prompts\search;

trait CanSearchHost
{
    public function searchHost(): int|string
    {
        return search(
            label: 'Select a host',
            placeholder: 'Search...',
            options: fn ($value) => strlen($value) > 0
                ? app(HostService::class)->search($value)
                : []
        );
    }
}
