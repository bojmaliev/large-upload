<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureModels();
        $this->largeFileUploadWorkaround();
    }

    /**
     * Injects addition options to the default disk to allow faster Storage::copy and Storage::move
     */
    protected function largeFileUploadWorkaround()
    {
        $defaultDisk = config('filesystems.default');

        if (laravel_cloud() && ! config("filesystems.disks.{$defaultDisk}.options")) {
            config()->set("filesystems.disks.{$defaultDisk}.options", [
                'mup_threshold' => 1024 * 1024 * 64,
                'concurrency' => 100,
            ]);
        }
    }

    /**
     * Configure the Eloquent models.
     */
    protected function configureModels()
    {
        Model::unguard();
    }
}
