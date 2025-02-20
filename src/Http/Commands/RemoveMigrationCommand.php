<?php
namespace Itpathsolutions\Sessionmanager\Http\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;

class RemoveMigrationCommand extends Command
{
    protected $signature = 'package:remove-migration';
    protected $description = 'Rollback and remove the published migration file';

    public function handle()
    {
        // Rollback migration before deletion
        $this->info("Rolling back migration...");
        Artisan::call('migrate:rollback', [
            '--path' => 'database/migrations' // Target migrations folder
        ]);
        $this->info(Artisan::output());

        // Locate the migration file using wildcard (*)
        $migrationFiles = glob(database_path('migrations/add_session_lifetime_to_roles.php'));

        if (!empty($migrationFiles)) {
            foreach ($migrationFiles as $file) {
                File::delete($file);
                $this->info("Deleted migration file: " . $file);
            }
        } else {
            $this->info("No matching migration file found.");
        }
    }
}
