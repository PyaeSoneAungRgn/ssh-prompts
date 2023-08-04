<?php

namespace App\Concerns;

use function Termwind\{render};

trait CanCopyToClipboard
{
    public function copyToClipboard(string $cmd): void
    {
        $exitCode = true;
        $osFamily = PHP_OS_FAMILY;
        if ($osFamily === 'Darwin') {
            exec('echo '.escapeshellarg($cmd).' | pbcopy', $output, $exitCode);
        } elseif ($osFamily == 'Linux') {
            exec('echo '.escapeshellarg($cmd).' | xsel --clipboard --input', $output, $exitCode);
        }

        $copyMessage = $exitCode === 0 ? 'Copied to clipboard!' : 'Unable to copy to clipboard!';
        $copyBackground = $exitCode === 0 ? 'bg-blue-300' : 'bg-red-300';

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
