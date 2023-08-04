<?php

namespace App\Commands\Host;

use App\Concerns\CanSearchHost;
use App\Services\HostService;
use Illuminate\Console\Scheduling\Schedule;
use function Laravel\Prompts\confirm;
use function Laravel\Prompts\outro;
use LaravelZero\Framework\Commands\Command;

class Delete extends Command
{
    use CanSearchHost;

    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'delete';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Delete a host';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(): void
    {
        $host = $this->searchHost();

        $confirm = confirm(
            label: 'Are you sure?',
        );

        if ($confirm) {
            app(HostService::class)->delete($host);
            outro('Successfully deleted!');
        }
    }

    /**
     * Define the command's schedule.
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
