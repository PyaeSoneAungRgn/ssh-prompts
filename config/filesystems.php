<?php

return [
    'default' => 'local',
    'disks' => [
        'local' => [
            'driver' => 'local',
            'root' => $_SERVER['HOME'].'/.ssh-prompts',
        ],
    ],
];
