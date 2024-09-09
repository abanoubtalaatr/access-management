<?php

namespace BirdSol\AccessManagement\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class AppendServiceProviderCommand extends Command
{
    protected $signature = 'access-management:append-provider';
    protected $description = 'Append AccessManagementServiceProvider to the providers array in bootstrap/providers.php';

    public function handle()
    {
        $providersFile = base_path('bootstrap/providers.php');
        $providerClass = "BirdSol\\AccessManagement\\AccessManagementServiceProvider::class,";

        if (File::exists($providersFile)) {
            $content = File::get($providersFile);

            if (!str_contains($content, $providerClass)) {
                // Add the provider class to the end of the array
                $newContent = str_replace(
                    "];", // replace the closing array bracket
                    "    $providerClass\n];", // with the provider and the closing bracket
                    $content
                );

                File::put($providersFile, $newContent);

                $this->info('AccessManagementServiceProvider appended to bootstrap/providers.php successfully.');
            } else {
                $this->info('AccessManagementServiceProvider is already present in bootstrap/providers.php.');
            }
        } else {
            $this->error('bootstrap/providers.php file does not exist.');
        }
    }
}
