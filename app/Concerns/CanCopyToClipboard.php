<?php

namespace App\Concerns;

use Illuminate\Support\Facades\Process;
use function Termwind\{render};

trait CanCopyToClipboard
{
    public function copyToClipboard(string $cmd): void
    {
        $success = false;
        $osFamily = PHP_OS_FAMILY;
        if ($osFamily === 'Darwin') {
            $process = Process::run('echo '.escapeshellarg($cmd).' | pbcopy');
            $success = $process->successful();
        } elseif ($osFamily == 'Linux') {
            $process = Process::run('echo '.escapeshellarg($cmd).' | xsel --clipboard --input');
            $success = $process->successful();
        } elseif ($osFamily == 'Windows') {
            $process = Process::run('echo '.escapeshellarg($cmd).' | clip');
            $success = $process->successful();
        }

        if ($success) {
            $copyMessage = 'Copied to clipboard!';
            $copyBackground = 'bg-blue-300';
        } else {
            $copyMessage = 'Unable to copy to clipboard!';
            $copyBackground = 'bg-red-300';
        }

        render(<<<"HTML"
            <div class="py-1 ml-2">
                <div class="px-1 $copyBackground text-black">$copyMessage</div>
                <em class="ml-1">
                  $cmd
                </em>
            </div>
        HTML);
    }
}
