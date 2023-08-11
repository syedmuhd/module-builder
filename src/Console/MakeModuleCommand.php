<?php

namespace Syedmuhd\Builder\Console;

use Illuminate\Console\Command;

class MakeModuleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'builder:module {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate module skeleton';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Make a controller
        $this->call('builder:controller', [
            'name' => $this->moduleName(),
        ]);

        // Make a service
        $this->call('builder:service', [
            'name' => $this->moduleName(),
        ]);

        // Make a request
        $requestsAction = ['Get', 'Create', 'Update', 'Delete', 'DeleteMany', 'Restore', 'RestoreMany'];
        foreach ($requestsAction as $action) {
            $this->call('builder:request', [
                'name' => $this->moduleName(),
                'action' => $action
            ]);
        }

        // Make a repository
        $this->call('builder:repository', [
            'name' => $this->moduleName(),
        ]);

        // Make a model
        $this->call('builder:model', [
            'name' => $this->moduleName(),
        ]);

        // Make a migration
        $this->call('builder:migration', [
            'name' => $this->moduleName(),
        ]);

        // Make a route
        $this->call('builder:route', [
            'name' => $this->moduleName(),
        ]);
    }

    protected function moduleName(): string
    {
        return ucfirst($this->argument('name'));
    }
}
