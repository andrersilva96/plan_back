<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Process;

class InstallApp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install:app';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the application.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        config('app.env') === 'local' ? $this->runLocalhost() : $this->runProduction();
        $this->info('The server: ' . config('app.url') . ' has been installed.');
    }

    public function runLocalhost()
    {
        $this->call('key:generate');
        $this->call('migrate:fresh');
        $this->command('php artisan db:seed');
        $this->command('php artisan storage:link --force');             // To event listener handler
        $this->command('npm install');
        $this->command('npm run build');
        $this->command('git reset --hard');
    }

    public function runProduction()
    {
        if ($this->confirm('Are you sure you want to run this command?')) {
            $this->command('composer install --no-dev --prefer-dist --optimize-autoloader --ignore-platform-reqs');
            $this->call('key:generate', ['--force' => true]);
            $this->call('migrate:fresh', ['--force' => true]);
            $this->command('php artisan db:seed --force');
            $this->command('php artisan storage:link --force');         // To event listener handler
            $this->createCrontab();
            $this->command('npm install');
            $this->command('npm run build');
            $this->call('optimize');
            $this->command('git reset --hard');
        }
    }

    public function command(string $command): void
    {
        Process::run($command, function (string $type, string $output) {
            echo $output;
        });
    }

    private function createCrontab()
    {
        $path = base_path();
        Process::run("crontab -l | grep '$path'", function (string $type, string $output) use ($path) {
            if (!$output) {
                $task = "* * * * * cd $path && php artisan schedule:run >> /dev/null 2>&1";
                exec('(crontab -l 2>/dev/null; echo "' . $task . '") | crontab -');
                return $this->info("Base cron task for scheduling work created. Task: $task");
            }
            return $this->info("Crontab already exists!");
        });
    }
}
