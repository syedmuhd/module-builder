<?php

namespace Syedmuhd\Builder;

use Syedmuhd\Builder\Console\InstallBuilder;
use Syedmuhd\Builder\Console\MakeModuleCommand;
use Syedmuhd\Builder\Console\MakeControllerCommand;
use Syedmuhd\Builder\Console\MakeServiceCommand;
use Syedmuhd\Builder\Console\MakeRequestCommand;
use Syedmuhd\Builder\Console\MakeRepositoryCommand;
use Syedmuhd\Builder\Console\MakeModelCommand;
use Syedmuhd\Builder\Console\MakeMigrationCommand;
use Syedmuhd\Builder\Console\MakeRouteCommand;
use Illuminate\Support\ServiceProvider;

class BuilderServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Register the command, on in CLI mode
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallBuilder::class,
                MakeModuleCommand::class,
                MakeControllerCommand::class,
                MakeServiceCommand::class,
                MakeRequestCommand::class,
                MakeRepositoryCommand::class,
                MakeModelCommand::class,
                MakeMigrationCommand::class,
                MakeRouteCommand::class,
            ]);
        }
    }

    public function register()
    {
    }
}
