<?php

namespace App\Concerns;

use function Laravel\Prompts\text;

trait CanAskPort
{
    public function askPort(string $default = '22')
    {
        return text(
            label: 'What is your host port?',
            placeholder: 'E.g. 22',
            required: true,
            default: $default,
            validate: fn ($value) => match (true) {
                ! ($value >= 0 && $value <= 65535 && filter_var($value, FILTER_VALIDATE_INT)) => 'Please enter valid port.',
                default => null,
            },
        );
    }
}
