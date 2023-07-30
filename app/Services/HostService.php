<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HostService
{
    public function __construct(
        private readonly string $path
    ) {
        $this->setup();
    }

    public function collect()
    {
        return collect(Storage::json($this->path));
    }

    public function find($id)
    {
        return $this->collect()->where('id', $id)->first();
    }

    public function search($label)
    {
        return $this->collect()
            ->filter(function ($host) use ($label) {
                return Str::contains($host['label'], $label, true);
            })
            ->pluck('label', 'id')
            ->toArray();
    }

    public function create($payload)
    {
        $hosts = array_merge($this->collect()->toArray(), [$payload]);
        $this->put($hosts);
    }

    public function update($id, $payload)
    {
        $hosts = $this->collect()
            ->map(function ($host) use ($id, $payload) {
                if ($host['id'] == $id) {
                    return array_merge($host, $payload);
                }

                return $host;
            });
        $this->put($hosts);
    }

    public function delete($id)
    {
        $hosts = $this->collect()->where('id', '!=', $id)->toArray();
        $this->put($hosts);
    }

    public function clean()
    {
        if (Storage::exists($this->path)) {
            Storage::delete($this->path);
        }
    }

    private function put($hosts)
    {
        Storage::put($this->path, json_encode($hosts));
    }

    private function setup(): void
    {
        if (! Storage::exists($this->path)) {
            Storage::put($this->path, json_encode([]));
        }
    }
}
