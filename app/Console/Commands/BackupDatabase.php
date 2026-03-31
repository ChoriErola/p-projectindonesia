<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class BackupDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:database {--path=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup database ke file SQL';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('➤ Memulai backup database...');

        try {
            $database = config('database.connections.mysql.database');
            $username = config('database.connections.mysql.username');
            $password = config('database.connections.mysql.password');
            $host = config('database.connections.mysql.host');

            // Tentukan path output
            $backupPath = $this->option('path') ?? storage_path('backups');
            
            // Buat folder jika belum ada
            if (!is_dir($backupPath)) {
                mkdir($backupPath, 0755, true);
            }

            $timestamp = Carbon::now()->format('Y-m-d_H-i-s');
            $filename = "{$database}_{$timestamp}.sql";
            $filepath = "{$backupPath}\\{$filename}";

            // Cari lokasi mysqldump
            $mysqldump = $this->findMysqldump();
            
            if (!$mysqldump) {
                $this->error('✗ mysqldump tidak ditemukan. Pastikan MySQL sudah terinstall.');
                return 1;
            }

            // Build command
            $command = "\"{$mysqldump}\" -h {$host} -u {$username}";
            
            if ($password) {
                $command .= " -p{$password}";
            }
            
            $command .= " {$database} > \"{$filepath}\"";

            // Execute backup
            $output = [];
            $returnVar = 0;
            
            exec($command, $output, $returnVar);

            if ($returnVar === 0 && file_exists($filepath)) {
                $filesize = filesize($filepath);
                $this->info("✓ Backup berhasil dibuat!");
                $this->line("  File: {$filename}");
                $this->line("  Ukuran: " . $this->formatBytes($filesize));
                $this->line("  Path: {$filepath}");

                // Hapus backup lama (lebih dari 7 hari)
                $this->cleanOldBackups($backupPath);

                return 0;
            } else {
                $this->error('✗ Backup gagal. Error: ' . implode("\n", $output));
                return 1;
            }

        } catch (\Exception $e) {
            $this->error('✗ Error: ' . $e->getMessage());
            return 1;
        }
    }

    /**
     * Cari lokasi mysqldump
     */
    private function findMysqldump()
    {
        $possiblePaths = [
            'D:\\laragon\\bin\\mysql\\mysql-5.7.39-winx64\\bin\\mysqldump.exe',
            'D:\\laragon\\bin\\mysql\\mysql-8.0.30-winx64\\bin\\mysqldump.exe',
            'C:\\laragon\\bin\\mysql\\mysql-5.7.39-winx64\\bin\\mysqldump.exe',
            'C:\\laragon\\bin\\mysql\\mysql-8.0.30-winx64\\bin\\mysqldump.exe',
            'C:\\Program Files\\MySQL\\MySQL Server 8.0\\bin\\mysqldump.exe',
            'C:\\Program Files\\MySQL\\MySQL Server 5.7\\bin\\mysqldump.exe',
        ];

        foreach ($possiblePaths as $path) {
            if (file_exists($path)) {
                return $path;
            }
        }

        // Try system PATH
        exec('where mysqldump.exe', $output, $return);
        if ($return === 0 && !empty($output)) {
            return trim($output[0]);
        }

        return null;
    }

    /**
     * Hapus backup yang lebih dari X hari
     */
    private function cleanOldBackups($backupPath, $daysOld = 7)
    {
        $files = glob("{$backupPath}/*.sql");
        $now = time();
        $maxAge = $daysOld * 24 * 60 * 60;

        foreach ($files as $file) {
            if (is_file($file)) {
                if ($now - filemtime($file) >= $maxAge) {
                    unlink($file);
                    $this->info("  [Cleanup] Backup lama dihapus: " . basename($file));
                }
            }
        }
    }

    /**
     * Format bytes ke format yang readable
     */
    private function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, $precision) . ' ' . $units[$i];
    }
}
