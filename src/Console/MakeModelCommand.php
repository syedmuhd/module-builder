<?php

namespace Syedmuhd\Builder\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class MakeModelCommand extends Command
{

    protected $signature = 'builder:model {name}';
    protected $description = 'Create a new model class';

    protected function getStub()
    {
        return __DIR__ . '/stubs/model.php.stub';
    }

    protected function moduleName($plural = false)
    {
        if ($plural) {
            return Str::ucfirst(Str::plural($this->argument('name')));
        } else {
            return Str::ucfirst(Str::singular($this->argument('name')));
        }
    }

    protected function modulePath()
    {
        return app_path("Models/{$this->moduleName()}");
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

        $content = file_get_contents($this->getStub());
        $content = str_replace(
            '%ModuleName%',
            $this->moduleName(),
            $content
        );

        if (!is_dir($this->modulePath())) {
            mkdir($this->modulePath(), 0777, true);
        } else {
            $this->error("{$this->moduleName()}.php already exists.");
            return false;
        }

        file_put_contents($this->modulePath() . '/' . $this->moduleName() . $this->fileType(), $content);

        $this->info("{$this->moduleName()}.php created successfully.");
    }
}
