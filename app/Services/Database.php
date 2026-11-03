<?php

namespace App\Services;

class Database
{
    protected string $driver;

    public function __construct(string $driver = 'Database')
    {
        $this->driver = $driver;
    }

    public function query(string $sql): array
    {
        try {
            $results = \Illuminate\Support\Facades\DB::select($sql);
            return [
                "rows" => $results,
                "count" => count($results),
            ];
        } catch (\Exception $e) {
            return ["error" => $e->getMessage()];
        }
    }

    public function run(string $query): array
    {
        return $this->query($query);
    }

}
