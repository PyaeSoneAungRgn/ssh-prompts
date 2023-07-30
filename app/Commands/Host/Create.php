<?php

namespace App\Commands\Host;

use App\Concerns\CanAskAddress;
use App\Concerns\CanAskLabel;
use App\Concerns\CanAskPort;
use App\Concerns\CanAskSshKey;
use App\Concerns\CanAskUsername;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Str;
use function Laravel\Prompts\outro;
use LaravelZero\Framework\Commands\Command;

class Create extends Command
{
    use CanAskLabel, CanAskAddress, CanAskPort, CanAskUsername, CanAskSshKey;

    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'create';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Create a host';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $label = $this->askLabel();
        $address = $this->askAddress();
        $port = $this->askPort();
        $username = $this->askUsername();
        $keyPath = $this->askSshKey();

        app('hosts')->create([
            'id' => Str::uuid()->toString(),
            'label' => $label,
            'address' => $address,
            'port' => $port,
            'username' => $username,
            'key_path' => $keyPath,
        ]);

        outro('Successfully created!');
    }

    /**
     * Define the command's schedule.
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
