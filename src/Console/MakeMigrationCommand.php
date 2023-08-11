<?php

namespace Syedmuhd\Builder\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class MakeMigrationCommand extends Command
{

    protected $signature = 'builder:migration {name}';
    protected $description = 'Create a new migration class';

    protected function getStub()
    {
        return __DIR__ . '/stubs/migration.php.stub';
    }

    protected function moduleName($plural = false)
    {
        if ($plural) {
            return Str::lower(Str::plural($this->argument('name')));
        } else {
            return Str::lower(Str::singular($this->argument('name')));
        }
    }

    protected function modulePath()
    {
        return base_path("database/migrations/" . date('Y_m_d_His') . "_create");
    }

    protected function fileType()
    {
        return '_table.php';
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
            $this->moduleName($plural = true),
            $content
        );

        file_put_contents($this->modulePath() . '_' . $this->moduleName($plural = true) . $this->fileType(), $content);

        $this->info("{$this->moduleName()}.php created successfully.");
    }
}
