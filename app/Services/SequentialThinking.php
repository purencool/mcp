<?php

namespace App\Services;

class SequentialThinking
{
    protected string $driver;

    public function __construct(string $driver = 'SequentialThinking')
    {
        $this->driver = $driver;
    }

    public function think(string $query): array
    {
        return [
            "thought" => $query,
            "step" => 1,
            "total_steps" => null,
            "next_thought_needed" => true,
            "instruction" => "Break the problem into steps. Provide step 1 reasoning, then request step 2.",
        ];
    }

    public function run(string $query): array
    {
        return $this->think($query);
    }

}
