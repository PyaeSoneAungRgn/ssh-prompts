<?php

namespace App\Commands\Host;

use App\Concerns\CanCopyToClipboard;
use App\Concerns\CanGenerateSshCmd;
use App\Concerns\CanSearchHost;
use App\Services\HostService;
use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class Search extends Command
{
    use CanSearchHost, CanGenerateSshCmd, CanCopyToClipboard;

    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'search';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Search a host';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(): void
    {
        $host = $this->searchHost();

        $host = app(HostService::class)->find($host);

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
