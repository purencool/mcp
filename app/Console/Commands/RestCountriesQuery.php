<?php

namespace App\Console\Commands;

use App\Services\RestCountries;
use Illuminate\Console\Command;

class RestCountriesQuery extends Command
{
    protected $signature = 'mcp:country {query : Country name} {--json : Output as JSON} {--driver= : Driver name}';
    protected $description = 'Get country data via REST Countries';

    public function handle(): int
    {
        $driver = $this->option('driver') ?? 'country';
        $result = (new RestCountries($driver))->search($this->argument('query'));

        if ($this->option('json')) {
            $this->line(json_encode($result));
        } else {
            $this->line(json_encode($result, JSON_PRETTY_PRINT));
        }
        return self::SUCCESS;
    }
}
