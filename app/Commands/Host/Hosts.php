<?php

namespace App\Commands\Host;

use App\Concerns\CanCopyToClipboard;
use App\Concerns\CanGenerateSshCmd;
use App\Services\HostService;
use Illuminate\Console\Scheduling\Schedule;
use function Laravel\Prompts\select;
use LaravelZero\Framework\Commands\Command;
use function Termwind\{render};

class Hosts extends Command
{
    use CanGenerateSshCmd, CanCopyToClipboard;

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
    public function handle(): void
    {
        $hosts = app(HostService::class)->collect();
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
            label: 'Choose a host',
            options: $options,
        );

        $host = $hosts->where('id', $host)->first();

        $cmd = $this->generateSshCmd($host);

        $this->copyToClipboard($cmd);
    }

    /**
     * Define the command's schedule.
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
