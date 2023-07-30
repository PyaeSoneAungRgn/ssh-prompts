<?php

namespace App\Concerns;

use function Laravel\Prompts\text;

trait CanAskUsername
{
    public function askUsername(string $default = '')
    {
        return text(
            label: 'What is your host username?',
            placeholder: 'E.g. root',
            default: $default,
            required: true,
            validate: fn ($value) => match (true) {
                ! $value => 'Please enter host username.',
                default => null,
            },
        );
    }
}
