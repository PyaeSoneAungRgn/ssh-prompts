<?php

namespace App\Commands\Host;

use App\Concerns\CanAskAddress;
use App\Concerns\CanAskLabel;
use App\Concerns\CanAskPort;
use App\Concerns\CanAskSshKey;
use App\Concerns\CanAskUsername;
use App\Concerns\CanSearchHost;
use App\Services\HostService;
use Illuminate\Console\Scheduling\Schedule;
use function Laravel\Prompts\outro;
use LaravelZero\Framework\Commands\Command;

class Edit extends Command
{
    use CanAskLabel, CanAskAddress, CanAskPort, CanAskUsername, CanAskSshKey, CanSearchHost;

    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'edit';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Update a host';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(): void
    {
        $host = $this->searchHost();

        $host = app(HostService::class)->find($host);

        $label = $this->askLabel($host['label']);
        $address = $this->askAddress($host['address']);
        $port = $this->askPort($host['port']);
        $username = $this->askUsername($host['username']);
        $keyPath = $this->askSshKey($host['key_path']);

        app(HostService::class)->update($host['id'], [
            'label' => $label,
            'address' => $address,
            'port' => $port,
            'username' => $username,
            'key_path' => $keyPath,
        ]);

        outro('Successfully updated!');
    }

    /**
     * Define the command's schedule.
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
