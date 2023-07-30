<?php

namespace App\Concerns;

use function Laravel\Prompts\text;

trait CanAskSshKey
{
    public function askSshKey(string $default = '')
    {
        return text(
            label: 'What is your ssh key path? (Optional)',
            placeholder: 'E.g. ~/.ssh/id_rsa',
            default: $default
        );
    }
}
