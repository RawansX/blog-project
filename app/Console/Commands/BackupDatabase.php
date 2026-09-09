<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('backup:database')]
#[Description('Create a backup of the database')]
class BackupDatabase extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $database = env('DB_DATABASE');
        $username = env('DB_USERNAME');
        $password = env('DB_PASSWORD');
        $host = env('DB_HOST');

        $backupPath = storage_path('app/backups');

        if (! file_exists($backupPath)) {
            mkdir($backupPath, 0755, true);
        }

        $fileName = 'backup_' . now()->format('Y-m-d_H-i-s') . '.sql';
        $filePath = $backupPath . DIRECTORY_SEPARATOR . $fileName;

        $command = "mysqldump --user={$username} --password={$password} --host={$host} {$database} > \"{$filePath}\"";

        exec($command, $output, $resultCode);

        if ($resultCode === 0) {
            $this->info("The backup was created successfully. {$fileName}");
        } else {
            $this->error('Backup creation failed.');
        }
    }
}