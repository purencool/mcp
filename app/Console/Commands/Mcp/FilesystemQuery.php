<?php

namespace App\Console\Commands\Mcp;

use Illuminate\Console\Command;
use App\Services\Filesystem;

class FilesystemQuery extends Command
{
    protected $signature = 'mcp:filesystem {query : The query/argument} {--json : Output as JSON} {--driver= : Driver name}';
    protected $description = 'List, read, search local files';

    public function handle(): int
    {
        $driver = $this->option('driver') ?? 'filesystem';
        $result = (new ($driver))->list($this->argument('query'));

        if ($this->option('json')) {
            $this->line(json_encode($result));
        } else {
            $this->line(json_encode($result, JSON_PRETTY_PRINT));
        }
        return self::SUCCESS;
    }
}
