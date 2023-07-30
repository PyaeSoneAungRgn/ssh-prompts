<?php

namespace App\Commands\Host;

use Illuminate\Console\Scheduling\Schedule;
use function Laravel\Prompts\confirm;
use function Laravel\Prompts\outro;
use function Laravel\Prompts\search;
use LaravelZero\Framework\Commands\Command;

class Delete extends Command
{
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
    public function handle()
    {
        $host = search(
            label: 'Select a host',
            placeholder: 'Search...',
            options: fn ($value) => strlen($value) > 0
                ? app('hosts')->search($value)
                : []
        );

        $confirm = confirm(
            label: 'Are you sure?',
        );

        if ($confirm) {
            app('hosts')->delete($host);
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
