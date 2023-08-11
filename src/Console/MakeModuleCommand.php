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
            'name' => $this->argument('name'),
        ]);

        // Make a service
        $this->call('builder:service', [
            'name' => $this->argument('name'),
        ]);

        // Make a request
        $requestsAction = ['Get', 'Create', 'Update', 'Delete', 'DeleteMany', 'Restore', 'RestoreMany'];
        foreach ($requestsAction as $action) {
            $this->call('builder:request', [
                'name' => $this->argument('name'),
                'action' => $action
            ]);
        }

        // Make a repository
        $this->call('builder:repository', [
            'name' => $this->argument('name'),
        ]);

        // Make a model
        $this->call('builder:model', [
            'name' => $this->argument('name'),
        ]);

        // Make a migration
        $this->call('builder:migration', [
            'name' => $this->argument('name'),
        ]);

        // Make a route
        $this->call('builder:route', [
            'name' => $this->argument('name'),
        ]);
    }
}
