<?php

namespace App\Concerns;

trait CanGenerateSshCmd
{
    public function generateSshCmd(array $host): string
    {
        $cmd = 'ssh '.$host['username'].'@'.$host['address'].' -p '.$host['port'];
        if ($host['key_path']) {
            $cmd .= ' -i '.$host['key_path'];
        }

        return $cmd;
    }
}
