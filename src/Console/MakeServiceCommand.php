<?php

namespace Syedmuhd\Builder\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class MakeServiceCommand extends Command
{

    protected $signature = 'builder:service {name}';
    protected $description = 'Create a new service class';

    protected function getStub()
    {
        return __DIR__ . '/stubs/service.php.stub';
    }

    protected function moduleName($plural = false, $lower = false)
    {
        if ($plural) {
            if ($lower) {
                return Str::lower(Str::plural($this->argument('name')));
            } else {
                return Str::ucfirst(Str::plural($this->argument('name')));
            }
        } else {
            if ($lower) {
                return Str::lower(Str::singular($this->argument('name')));
            } else {
                return Str::ucfirst(Str::singular($this->argument('name')));
            }
        }
    }

    protected function modulePath()
    {
        return app_path("Services/{$this->moduleName()}");
    }

    protected function fileType()
    {
        return 'Service.php';
    }

    public function handle()
    {
        $this->generate();
    }

    protected function generate()
    {

        $content = file_get_contents($this->getStub());
        $content = str_replace(
            '%ModuleName%',
            $this->moduleName(),
            $content
        );
        $content = str_replace(
            '%ModuleNameLowerSingular%',
            $this->moduleName($plural = false, $lower = true),
            $content
        );

        if (!is_dir($this->modulePath())) {
            mkdir($this->modulePath(), 0777, true);
        } else {
            $this->error("{$this->moduleName()}Service already exists.");
            return false;
        }

        file_put_contents($this->modulePath() . '/' . $this->moduleName() . $this->fileType(), $content);

        $this->info("{$this->moduleName()}Service created successfully.");
    }
}
