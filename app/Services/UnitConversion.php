<?php

namespace App\Services;

class UnitConversion
{
    protected string $driver;

    public function __construct(string $driver = 'UnitConversion')
    {
        $this->driver = $driver;
    }

    public function convert(string $query): array
    {
        // Format: "100 km to miles" or "100 c to f"
        $m = null;
        if (!preg_match("/([\d.]+)\s*(\w+)\s+to\s+(\w+)/i", trim($query), $m)) {
            return ["error" => "Format: <number> <unit> to <unit>"];
        }
        $value = (float) $m[1];
        $from = strtolower($m[2]);
        $to = strtolower($m[3]);

        $factors = [
            "km" => 1, "m" => 0.001, "mi" => 1.60934, "ft" => 0.0003048, "cm" => 0.01,
            "kg" => 1, "g" => 0.001, "lb" => 0.453592, "oz" => 0.0283495,
            "c" => null, "f" => null, "k" => null,
            "l" => 1, "ml" => 0.001, "gal" => 3.78541,
        ];

        // Temperature special case
        if (in_array($from, ["c", "f", "k"]) && in_array($to, ["c", "f", "k"])) {
            $c = match($from) { "c" => $value, "f" => ($value - 32) * 5/9, "k" => $value - 273.15 };
            $result = match($to) { "c" => $c, "f" => $c * 9/5 + 32, "k" => $c + 273.15 };
            return ["input" => $value . "°" . strtoupper($from), "output" => round($result, 4) . "°" . strtoupper($to)];
        }

        if (!isset($factors[$from]) || !isset($factors[$to])) {
            return ["error" => "Unknown unit: $from or $to"];
        }
        $base = $value * $factors[$from];
        $result = $base / $factors[$to];
        return ["input" => $value . " $from", "output" => round($result, 6) . " $to"];
    }

    public function run(string $query): array
    {
        return $this->convert($query);
    }

}
