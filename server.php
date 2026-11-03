#!/usr/bin/env php
<?php
require __DIR__ . "/vendor/autoload.php";

$app = require_once __DIR__ . "/bootstrap/app.php";

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$command = $argv[1] ?? "";
$query = $argv[2] ?? "";
$driver = $argv[3] ?? null;

if (empty($command)) {
    fwrite(
        STDERR,
        json_encode([
            "error" => 'Usage: php server.php <command> "query" [driver]',
        ]) . "\n",
    );
    exit(1);
}

switch ($command) {
    case "search":
        if (empty($query)) {
            fwrite(STDERR, json_encode(["error" => "Missing query"]) . "\n");
            exit(1);
        }
        $args = ["query" => $query, "--json" => true];
        if ($driver) {
            $args["--driver"] = $driver;
        }
        Artisan::call("mcp:search", $args);
        break;

    case "drivers":
        $available = array_keys(config("search.drivers"));
        $default = config("search.default");
        echo json_encode([
            "default" => $default,
            "available" => $available,
        ]) . "\n";
        exit(0);

    default:
        fwrite(
            STDERR,
            json_encode(["error" => "Unknown command: {$command}"]) . "\n",
        );
        exit(1);
}

echo Artisan::output() . "\n";

