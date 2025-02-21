<?php

namespace Itpathsolutions\Sessionmanager\Http\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class RemoveMigrationCommand extends Command
{
    protected $signature = 'package:remove-migration';
    protected $description = 'Rollback and remove the published migration file';

    public function handle()
    {
        $this->info("Rolling back migration...");

        // Rollback the specific migration
        Artisan::call('migrate:rollback');
        $this->info(Artisan::output());
        Log::info(Artisan::output());

        // Find migration file dynamically
        $migrationFiles = glob(database_path('migrations/*_add_session_lifetime_to_roles.php'));

        if (!empty($migrationFiles)) {
            foreach ($migrationFiles as $file) {
                if (File::exists($file)) {
                    File::delete($file);
                    $this->info("Deleted migration file: " . $file);
                    Log::info("Deleted migration file: " . $file);
                }
            }
        } else {
            $this->info("No matching migration file found.");
            Log::info("No matching migration file found.");
        }
    }
}
