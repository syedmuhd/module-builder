<?php

namespace Syedmuhd\Builder\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class MakeRequestCommand extends Command
{

    protected $signature = 'builder:request {name} {action}';
    protected $description = 'Create a new request class';

    protected function getStub()
    {
        return __DIR__ . '/stubs/request.php.stub';
    }

    protected function moduleName()
    {
        return Str::ucfirst(Str::singular($this->argument('name')));
    }

    protected function modulePath()
    {
        return app_path("Http/Requests/{$this->moduleName()}");
    }

    protected function fileType()
    {
        return 'Request.php';
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
            '%Type%',
            $this->argument('action'),
            $content
        );

        if (!is_dir($this->modulePath())) {
            mkdir($this->modulePath(), 0777, true);
        } else if (file_exists($this->modulePath() . '/' . $this->moduleName() . $this->argument('action') . $this->fileType())) {
            $this->info("{$this->moduleName()}{$this->fileType()} already exist.");
        }

        file_put_contents($this->modulePath() . '/' . $this->moduleName() . $this->argument('action') . $this->fileType(), $content);

        $this->info("{$this->moduleName()}{$this->fileType()} created successfully.");
    }
}
