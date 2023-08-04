<?php

namespace App\Concerns;

use function Laravel\Prompts\text;

trait CanAskAddress
{
    public function askAddress(string $default = ''): string
    {
        return text(
            label: 'What is your host address?',
            placeholder: 'E.g. 127.0.0.1',
            required: true,
            default: $default,
            validate: function ($value) {
                $isDomain = preg_match('/^(?!\-)(?:[\w\-]{0,62}\w)\.(?!-)(?:[\w\-]{0,62}\w)(?:\.(?!-)(?:[\w\-]{0,62}\w)){0,}$/', $value) === 1; // regex copy from ChatGPT
                $isIp = filter_var($value, FILTER_VALIDATE_IP);
                if ($isDomain || $isIp) {
                    return null;
                }

                return 'Please enter valid host address.';
            }
        );
    }
}
