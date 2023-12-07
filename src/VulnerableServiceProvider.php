<?php

declare(strict_types=1);

namespace HT\Pulse\Vulnerable;

use HT\Pulse\Vulnerable\Livewire\Vulnerable;
use Illuminate\Support\ServiceProvider;
use Livewire\LivewireManager;

final class VulnerableServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadViewsFrom(path: __DIR__.'/../resources/views', namespace: 'vulnerable');

        $this->callAfterResolving(name: 'livewire', callback: function (LivewireManager $livewire): void {
            $livewire->component(name: 'vulnerable', class: Vulnerable::class);
        });
    }
}
