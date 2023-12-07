<?php

declare(strict_types=1);

namespace HT\Pulse\Vulnerable\Livewire;

use Illuminate\Support\Facades\View;
use Laravel\Pulse\Facades\Pulse;
use Laravel\Pulse\Livewire\Card;
use Livewire\Attributes\Lazy;

final class Vulnerable extends Card
{
    #[Lazy]
    public function render()
    {
        $packages = Pulse::values(type: 'vulnerable', keys: ['result'])->first();

        $packages = $packages
            ? json_decode($packages->value, associative: true, flags: JSON_THROW_ON_ERROR)['advisories']
            : [];

        return View::make(view: 'vulnerable::livewire.vulnerable', data: [
            'packages' => $packages,
        ]);
    }
}
