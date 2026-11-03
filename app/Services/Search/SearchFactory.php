<?php

namespace App\Services\Search;

use App\Contracts\Searchable;

class SearchFactory
{
    public static function make(?string $driver = null): Searchable
    {
        $driver = $driver ?? config("search.default");

        if (!config("search.drivers.{$driver}")) {
            $available = array_keys(config("search.drivers"));
            throw new \RuntimeException(
                "Unknown driver [{$driver}]. Available: " .
                    implode(", ", $available),
            );
        }

        return new Search($driver);
    }
}
