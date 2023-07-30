<?php

namespace App\Commands\Host;

use Illuminate\Console\Scheduling\Schedule;
use function Laravel\Prompts\select;
use LaravelZero\Framework\Commands\Command;
use function Termwind\{render};

class Hosts extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'hosts';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'List all host';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $hosts = app('hosts')->collect();
        if ($hosts->count() == 0) {
            render(<<<'HTML'
                <div class="py-1 ml-2">
                    <div class="px-1 bg-blue-300 text-black">Empty!</div>
                    <em class="ml-1">
                      Please create a host first.
                    </em>
                </div>
            HTML);

            return;
        }

        $options = [];
        foreach ($hosts->toArray() as $host) {
            $options[$host['id']] = $host['label'].' -> '.$host['address'];
        }

        $host = select(
            label: 'Choose a host.',
            options: $options,
        );

        $host = $hosts->where('id', $host)->first();

        $cmd = 'ssh '.$host['username'].'@'.$host['address'].' -p '.$host['port'];
        if ($host['key_path']) {
            $cmd .= ' -i '.$host['key_path'];
        }

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

    /**
     * Define the command's schedule.
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
