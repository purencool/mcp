#!/usr/bin/env php
<?php
require __DIR__ . "/vendor/autoload.php";

$app = require_once __DIR__ . "/bootstrap/app.php";

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$command = $argv[1] ?? "";
$query = $argv[2] ?? "";
$driver = $argv[3] ?? null;
$arg4 = $argv[4] ?? null;

if (empty($command)) {
    fwrite(
        STDERR,
        json_encode(
            [
                "error" =>
                    "Usage: php server.php <command> <arg1> [arg2] [arg3]",
                "hint" => "Run: php server.php help",
            ],
            JSON_PRETTY_PRINT,
        ) . "\n",
    );
    exit(1);
}

switch ($command) {
    case "search":
        $args = ["query" => $query, "--json" => true];
        if ($driver) {
            $args["--driver"] = $driver;
        }
        Artisan::call("mcp:search", $args);
        break;

    case "weather":
        Artisan::call("mcp:weather", [
            "lat" => $query,
            "lng" => $driver ?: "151.2",
            "--json" => true,
        ]);
        break;

    case "countries":
        Artisan::call("mcp:countries", ["name" => $query, "--json" => true]);
        break;

    case "tavily":
        Artisan::call("mcp:tavily", ["query" => $query, "--json" => true]);
        break;

    case "exa":
        Artisan::call("mcp:exa", ["query" => $query, "--json" => true]);
        break;

    case "tinyfish":
        Artisan::call("mcp:tinyfish", ["query" => $query, "--json" => true]);
        break;

    case "wikipedia":
        Artisan::call("mcp:wikipedia", ["title" => $query, "--json" => true]);
        break;

    case "library":
        Artisan::call("mcp:library", ["query" => $query, "--json" => true]);
        break;

    case "news":
        Artisan::call("mcp:news", ["query" => $query, "--json" => true]);
        break;

    case "crypto":
        Artisan::call("mcp:crypto", [
            "coins" => $query,
            "--vs-currency" => $driver ?: "aud",
            "--json" => true,
        ]);
        break;

    case "exchange":
        Artisan::call("mcp:exchange", [
            "from" => $query,
            "to" => $driver ?: "AUD",
            "--json" => true,
        ]);
        break;

    case "geocode":
        Artisan::call("mcp:geocode", ["query" => $query, "--json" => true]);
        break;

    case "ip":
        Artisan::call("mcp:ip", ["address" => $query, "--json" => true]);
        break;

    case "github":
        Artisan::call("mcp:github", ["query" => $query, "--json" => true]);
        break;

    case "trivia":
        Artisan::call("mcp:trivia", [
            "--category" => $query ?: "9",
            "--difficulty" => $driver ?: "medium",
            "--json" => true,
        ]);
        break;

    case "sunrise":
        Artisan::call("mcp:sunrise", [
            "lat" => $query,
            "lng" => $driver ?: "151.2",
            "--json" => true,
        ]);
        break;
    case "help":
        $help = [
            "search" => 'php server.php search "query" [driver]',
            "weather" => "php server.php weather -33.87 151.21",
            "countries" => 'php server.php countries "Australia"',
            "tavily" => 'php server.php tavily "Laravel 12 features"',
            "exa" => 'php server.php exa "best PHP frameworks 2025"',
            "tinyfish" => 'php server.php tinyfish "MCP protocol"',
            "wikipedia" => 'php server.php wikipedia "Laravel"',
            "library" => 'php server.php library "Clean Code"',
            "news" => 'php server.php news "PHP 8.4"',
            "crypto" => 'php server.php crypto "bitcoin,ethereum"',
            "exchange" => "php server.php exchange USD AUD",
            "geocode" => 'php server.php geocode "Sydney"',
            "ip" => "php server.php ip 8.8.8.8",
            "github" => 'php server.php github "laravel mcp"',
            "trivia" => "php server.php trivia",
            "sunrise" => "php server.php sunrise -33.87 151.21",
            "holidays" => "php server.php holidays AU",
            "images" => 'php server.php images "sunset beach"',
            "drivers" => "php server.php drivers",
        ];

        echo json_encode(
            ["usage" => "php server.php <command> <args>", "commands" => $help],
            JSON_PRETTY_PRINT,
        ) . "\n";
        exit(0);

    case "holidays":
        Artisan::call("mcp:holidays", [
            "country" => $query,
            "--year" => $driver ?: date("Y"),
            "--json" => true,
        ]);
        break;

    case "images":
        Artisan::call("mcp:images", ["query" => $query, "--json" => true]);
        break;

    case "drivers":
        $available = array_keys(config("search.drivers"));
        $default = config("search.default");
        echo json_encode(["default" => $default, "available" => $available]) .
            "\n";
        exit(0);

    default:
        fwrite(
            STDERR,
            json_encode(["error" => "Unknown command: {$command}"]) . "\n",
        );
        exit(1);
}

echo Artisan::output() . "\n";

