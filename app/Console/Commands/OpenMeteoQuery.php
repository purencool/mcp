<?php

namespace App\Console\Commands;

use App\Services\OpenMeteo;
use Illuminate\Console\Command;

class OpenMeteoQuery extends Command
{
    protected $signature = 'mcp:weather {query : "lat,lon" or description} {--json : Output as JSON} {--driver= : Driver name}';
    protected $description = 'Get weather forecast via Open-Meteo';

    public function handle(): int
    {
        $driver = $this->option('driver') ?? 'weather';
        $result = (new OpenMeteo($driver))->search($this->argument('query'));

        if ($this->option('json')) {
            $this->line(json_encode($result));
        } else {
            $this->line(json_encode($result, JSON_PRETTY_PRINT));
        }
        return self::SUCCESS;
    }
}
