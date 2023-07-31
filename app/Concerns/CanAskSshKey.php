<?php

namespace App\Concerns;

use function Laravel\Prompts\suggest;

trait CanAskSshKey
{
    public function askSshKey(string $default = '')
    {
        return suggest(
            label: 'What is your ssh key path? (Optional)',
            placeholder: 'E.g. ~/.ssh/id_rsa',
            options: [
                '~/.ssh/id_rsa',
            ],
            default: $default
        );
    }
}
