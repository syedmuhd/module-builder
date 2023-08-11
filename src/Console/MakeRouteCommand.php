<?php

namespace Syedmuhd\Builder\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeRouteCommand extends Command
{

    protected $signature = 'builder:route {name}';
    protected $description = 'Create a new route class';

    protected function getStub()
    {
        return __DIR__ . '/stubs/route.php.stub';
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
        return base_path("routes/api/");
    }

    protected function fileType()
    {
        return '.php';
    }

    public function handle()
    {
        $this->generate();
    }

    protected function generate()
    {

        if (!File::exists($this->modulePath())) {
            File::makeDirectory($this->modulePath(), 0777, true, true);
        }

        $content = file_get_contents($this->getStub());
        $content = str_replace(
            '%ModuleName%',
            $this->moduleName(),
            $content
        );

        $content = str_replace(
            '%ModuleNameLowerPlural%',
            $this->moduleName($plural = true, $lower = true),
            $content
        );

        if (File::exists($this->modulePath() . $this->moduleName($plural = true, $lower = true))) {
            $this->error("{$this->moduleName()}{$this->fileType()} already exists.");
        } else {
            file_put_contents($this->modulePath() . '/' . $this->moduleName($plural = false, $lower = true) . $this->fileType(), $content);
            $this->info("{$this->moduleName()}{$this->fileType()} created successfully.");
        }
    }
}
