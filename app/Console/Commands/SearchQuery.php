<?php

namespace App\Console\Commands;

use App\Services\Search\SearchFactory;
use Illuminate\Console\Command;

class SearchQuery extends Command
{
    protected $signature = "mcp:search {query : The search query} {--json : Output as JSON} {--driver= : Driver name}";

    protected $description = "Search via the configured provider";

    public function handle(): int
    {
        $search = SearchFactory::make($this->option("driver"));
        $result = $search->search($this->argument("query"));

        if ($this->option("json")) {
            $this->line(json_encode($result));
            return self::SUCCESS;
        }

        if (isset($result["results"])) {
            $rows = collect($result["results"])
                ->map(
                    fn($r) => [
                        $r["title"] ?? ($r["heading"] ?? ""),
                        $r["snippet"] ?? ($r["abstract"] ?? ""),
                        $r["url"] ?? "",
                    ],
                )
                ->toArray();

            $this->table(
                ["Title", "Snippet", "URL"],
                $rows ?: [["No results"]],
            );
        } else {
            $this->table(
                ["Field", "Value"],
                [
                    ["Driver", $result["driver"]],
                    ["Heading", $result["heading"] ?? ""],
                    ["Abstract", $result["abstract"] ?? ""],
                    ["URL", $result["url"] ?? ""],
                ],
            );
        }

        return self::SUCCESS;
    }
}
