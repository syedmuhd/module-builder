<?php

namespace Syedmuhd\Builder\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class MakeControllerCommand extends Command
{

    protected $signature = 'builder:controller {name}';
    protected $description = 'Create a new controller class';

    protected function getStub()
    {
        return __DIR__ . '/stubs/controller.php.stub';
    }

    protected function moduleName()
    {
        return Str::ucfirst(Str::singular($this->argument('name')));
    }

    protected function modulePath()
    {
        return app_path("Http/Controllers/{$this->moduleName()}");
    }

    protected function fileType()
    {
        return 'Controller.php';
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
            $this->error("{$this->moduleName()}Controller already exists.");
            return false;
        }

        file_put_contents($this->modulePath() . '/' . $this->moduleName() . $this->fileType(), $content);

        $this->info("{$this->moduleName()}Controller created successfully.");
    }
}
