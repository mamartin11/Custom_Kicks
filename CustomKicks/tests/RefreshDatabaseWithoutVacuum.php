<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Testing\RefreshDatabase as BaseRefreshDatabase;

trait RefreshDatabaseWithoutVacuum
{
    use BaseRefreshDatabase;

    protected function refreshTestDatabase()
    {
        $this->artisan('migrate:fresh', [
            '--seed' => $this->shouldSeed(),
        ]);

        $this->app[Kernel::class]->setArtisan(null);
    }
} 