<?php

namespace App\Services;

class Memory
{
    protected string $driver;

    public function __construct(string $driver = 'Memory')
    {
        $this->driver = $driver;
    }

    public function store(string $query): array
    {
        $db = \Illuminate\Support\Facades\DB::connection("memory");
        $id = md5($query);
        $db->table("memories")->updateOrInsert(["key" => $id], ["value" => $query, "created_at" => now()]);
        return ["stored" => true, "key" => $id];
    }

    public function recall(string $query): array
    {
        $db = \Illuminate\Support\Facades\DB::connection("memory");
        $results = $db->table("memories")
            ->where("value", "like", "%{$query}%")
            ->limit(10)
            ->get();
        return $results->toArray();
    }

    public function run(string $query): array
    {
        return $this->recall($query);
    }

}
