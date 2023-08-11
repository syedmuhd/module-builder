<?php

namespace Syedmuhd\Builder\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallBuilder extends Command
{
    protected $signature = 'builder:install';

    protected $description = 'Install the necessary files for Laravel module builder package';

    public function handle()
    {
        $this->info('Publishing necessary Laravel module builder files...');

        $this->publishApiFiles();

        $this->info('Installed!');
    }

    // Publish base files
    private function publishApiFiles()
    {
        $this->copyApiFile();

        // ModelRepository.php
        if (File::exists(base_path('app/Repositories/ModelRepository.php'))) {
            $confirm = $this->confirm(
                'ModelRepository.php file already exists. Do you want to overwrite it?',
                false
            );

            if ($confirm) {
                $this->copyModelRepositoryFile();
            } else {
                $this->warn('Existing ModelRepository.php was not overwritten');
            }
        } else {
            $this->copyModelRepositoryFile();
        }

        // RepositoryContract.php
        if (File::exists(base_path('app/Repositories/RepositoryContract.php'))) {
            $confirm = $this->confirm(
                'RepositoryContract.php file already exists. Do you want to overwrite it?',
                false
            );

            if ($confirm) {
                $this->copyRepositoryContractFile();
            } else {
                $this->warn('Existing RepositoryContract.php was not overwritten');
            }
        } else {
            $this->copyRepositoryContractFile();
        }

        // ServiceContract.php
        if (File::exists(base_path('app/Services/ServiceContract.php'))) {
            $confirm = $this->confirm(
                'ServiceContract.php file already exists. Do you want to overwrite it?',
                false
            );

            if ($confirm) {
                $this->copyServiceContractFile();
            } else {
                $this->warn('Existing ServiceContract.php was not overwritten');
            }
        } else {
            $this->copyServiceContractFile();
        }
    }

    private function copyApiFile()
    {
        if (!is_dir(base_path('routes/api'))) {
            mkdir(base_path('routes/api'), 0777, true);
        }

        File::copy(__DIR__ . '/../Files/api.php', base_path('routes/api.php'));
    }

    private function copyModelRepositoryFile()
    {
        if (!is_dir(base_path('app/Repositories'))) {
            mkdir(base_path('app/Repositories'), 0777, true);
        }

        File::copy(__DIR__ . '/../Files/ModelRepository.php', base_path('app/Repositories/ModelRepository.php'));
    }

    private function copyRepositoryContractFile()
    {
        File::copy(__DIR__ . '/../Files/RepositoryContract.php', base_path('app/Repositories/RepositoryContract.php'));
    }

    private function copyServiceContractFile()
    {
        if (!is_dir(base_path('app/Services'))) {
            mkdir(base_path('app/Services'), 0777, true);
        }

        File::copy(__DIR__ . '/../Files/ServiceContract.php', base_path('app/Services/ServiceContract.php'));
    }
}
