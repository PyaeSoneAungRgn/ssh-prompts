<?php

namespace App\Commands\Host;

use App\Services\HostService;
use Illuminate\Console\Scheduling\Schedule;
use function Laravel\Prompts\outro;
use LaravelZero\Framework\Commands\Command;

class Clean extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'clean';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Clean json file';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(): void
    {
        app(HostService::class)->clean();
        outro('Successfully cleaned!');
    }

    /**
     * Define the command's schedule.
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
