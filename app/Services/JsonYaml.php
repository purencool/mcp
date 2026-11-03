<?php

namespace App\Services;

class JsonYaml
{
    protected string $driver;

    public function __construct(string $driver = 'JsonYaml')
    {
        $this->driver = $driver;
    }

    public function parse(string $query): array
    {
        $trimmed = trim($query);
        // Try JSON first
        $decoded = json_decode($trimmed, true);
        if ($decoded !== null || $trimmed === "null") {
            return ["format" => "json", "valid" => json_last_error() === JSON_ERROR_NONE, "data" => $decoded];
        }
        // Try YAML
        if (class_exists(\Symfony\Component\Yaml\Yaml::class)) {
            try {
                $data = \Symfony\Component\Yaml\Yaml::parse($trimmed);
                return ["format" => "yaml", "valid" => true, "data" => $data];
            } catch (\Exception $e) {
                return ["format" => "yaml", "valid" => false, "error" => $e->getMessage()];
            }
        }
        return ["format" => "unknown", "valid" => false, "error" => "Cannot parse"];
    }

    public function run(string $query): array
    {
        return $this->parse($query);
    }

}
