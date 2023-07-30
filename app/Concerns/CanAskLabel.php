<?php

namespace App\Concerns;

use function Laravel\Prompts\text;

trait CanAskLabel
{
    public function askLabel(string $default = '')
    {
        return text(
            label: 'What is your host label?',
            placeholder: 'E.g. Strawberry',
            required: true,
            default: $default,
            validate: fn ($value) => match (true) {
                ! $value => 'Please enter host label.',
                default => null,
            },
        );
    }
}
