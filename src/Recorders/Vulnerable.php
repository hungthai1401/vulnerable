<?php

declare(strict_types=1);

namespace HT\Pulse\Vulnerable\Recorders;

use Illuminate\Support\Facades\Process;
use Laravel\Pulse\Events\SharedBeat;
use Laravel\Pulse\Pulse;
use RuntimeException;

final class Vulnerable
{
    public string $listen = SharedBeat::class;

    public function __construct(protected Pulse $pulse)
    {
    }

    public function record(SharedBeat $event): void
    {
        if ($event->time !== $event->time->startOfDay()) {
            return;
        }

        $result = Process::run(command: 'composer audit -f json --locked');
        if ($result->failed()) {
            throw new RuntimeException(message: 'Composer audit failed: '.$result->errorOutput());
        }

        $this->pulse->set(type: 'vulnerable', key: 'result', value: $result->output());
    }
}
