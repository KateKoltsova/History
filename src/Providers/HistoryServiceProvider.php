<?php

namespace  Koltsova\History_writer\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Koltsova\History_writer\Observers\ModelHistoryObserver;
use function config_path;

class HistoryServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishConfig();
        $this->loadMigrations();
        $this->addObservers();
    }

    private function publishConfig(): void
    {
        $this->publishes([
            dirname(__DIR__, 2) . '/config/ElHistory.php' =>
                config_path('ElHistory.php'),
        ]);
    }

    private function loadMigrations(): void
    {
        $this->loadMigrationsFrom(dirname(__DIR__, 2) . '/database/migrations/2022_07_29_105435_create_models_history_table.php');
    }

    private function addObservers(): void
    {
        $models = Config::get('ElHistory.models_for_writing_history');
        if ($models) {
            foreach ($models as $model) {
                $model::observe(ModelHistoryObserver::class);
            }
        }
    }
}